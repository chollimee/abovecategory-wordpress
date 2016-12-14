(function() {
  'use strict';

  var globals = typeof window === 'undefined' ? global : window;
  if (typeof globals.require === 'function') return;

  var modules = {};
  var cache = {};
  var aliases = {};
  var has = ({}).hasOwnProperty;

  var expRe = /^\.\.?(\/|$)/;
  var expand = function(root, name) {
    var results = [], part;
    var parts = (expRe.test(name) ? root + '/' + name : name).split('/');
    for (var i = 0, length = parts.length; i < length; i++) {
      part = parts[i];
      if (part === '..') {
        results.pop();
      } else if (part !== '.' && part !== '') {
        results.push(part);
      }
    }
    return results.join('/');
  };

  var dirname = function(path) {
    return path.split('/').slice(0, -1).join('/');
  };

  var localRequire = function(path) {
    return function expanded(name) {
      var absolute = expand(dirname(path), name);
      return globals.require(absolute, path);
    };
  };

  var initModule = function(name, definition) {
    var hot = null;
    hot = hmr && hmr.createHot(name);
    var module = {id: name, exports: {}, hot: hot};
    cache[name] = module;
    definition(module.exports, localRequire(name), module);
    return module.exports;
  };

  var expandAlias = function(name) {
    return aliases[name] ? expandAlias(aliases[name]) : name;
  };

  var _resolve = function(name, dep) {
    return expandAlias(expand(dirname(name), dep));
  };

  var require = function(name, loaderPath) {
    if (loaderPath == null) loaderPath = '/';
    var path = expandAlias(name);

    if (has.call(cache, path)) return cache[path].exports;
    if (has.call(modules, path)) return initModule(path, modules[path]);

    throw new Error("Cannot find module '" + name + "' from '" + loaderPath + "'");
  };

  require.alias = function(from, to) {
    aliases[to] = from;
  };

  var extRe = /\.[^.\/]+$/;
  var indexRe = /\/index(\.[^\/]+)?$/;
  var addExtensions = function(bundle) {
    if (extRe.test(bundle)) {
      var alias = bundle.replace(extRe, '');
      if (!has.call(aliases, alias) || aliases[alias].replace(extRe, '') === alias + '/index') {
        aliases[alias] = bundle;
      }
    }

    if (indexRe.test(bundle)) {
      var iAlias = bundle.replace(indexRe, '');
      if (!has.call(aliases, iAlias)) {
        aliases[iAlias] = bundle;
      }
    }
  };

  require.register = require.define = function(bundle, fn) {
    if (typeof bundle === 'object') {
      for (var key in bundle) {
        if (has.call(bundle, key)) {
          require.register(key, bundle[key]);
        }
      }
    } else {
      modules[bundle] = fn;
      delete cache[bundle];
      addExtensions(bundle);
    }
  };

  require.list = function() {
    var list = [];
    for (var item in modules) {
      if (has.call(modules, item)) {
        list.push(item);
      }
    }
    return list;
  };

  var hmr = globals._hmr && new globals._hmr(_resolve, require, modules, cache);
  require._cache = cache;
  require.hmr = hmr && hmr.wrap;
  require.brunch = true;
  globals.require = require;
})();

(function() {
var global = window;
var __makeRelativeRequire = function(require, mappings, pref) {
  var none = {};
  var tryReq = function(name, pref) {
    var val;
    try {
      val = require(pref + '/node_modules/' + name);
      return val;
    } catch (e) {
      if (e.toString().indexOf('Cannot find module') === -1) {
        throw e;
      }

      if (pref.indexOf('node_modules') !== -1) {
        var s = pref.split('/');
        var i = s.lastIndexOf('node_modules');
        var newPref = s.slice(0, i).join('/');
        return tryReq(name, newPref);
      }
    }
    return none;
  };
  return function(name) {
    if (name in mappings) name = mappings[name];
    if (!name) return;
    if (name[0] !== '.' && pref) {
      var val = tryReq(name, pref);
      if (val !== none) return val;
    }
    return require(name);
  }
};
require.register("admin/scripts/ProductsShow.js", function(exports, require, module) {
var ProductsShow = {
  point_x: 0,
  point_y: 0,

  add_product: function()
  {
    jQuery('#acf-products .add-row-end').trigger('click');
    jQuery('#acf-products .row:last td[data-field_name=point_x] input').val(this.point_x);
    jQuery('#acf-products .row:last td[data-field_name=point_y] input').val(this.point_y);
  },

  add_product_marker: function(marker_id, x, y)
  {
    var marker = "<div id='" + marker_id + "' class='marker product'><i class='fa fa-plus'></i></div>";

    jQuery('#acf-image .has-image').append(marker);
    
    jQuery("#" + marker_id).css({left: x + '%', top: y + '%'});

    jQuery('.marker').draggable({
      stop: function(event) {
        ProductsShow.update_row_data(jQuery(this).attr('id'))
      }
    }).bind('click', function(){
      jQuery(this).focus();
    });
  },

  update_row_data: function(marker_id)
  {
    var tr = jQuery("#acf-products .row[data-marker="+marker_id+"]");
    var parentObject = jQuery('#acf-image .has-image');
    var parentWidth = parentObject.width();
    var parentHeight = parentObject.height();
    var marker = jQuery("#" + marker_id);

    var x = 100 * (( marker.offset().left - parentObject.offset().left ) / parentWidth);
    var y = 100 * (( marker.offset().top - parentObject.offset().top ) / parentHeight);

    ProductsShow.point_x = x;
    ProductsShow.point_y = y;

    ProductsShow.update_metabox();

    jQuery('td[data-field_name=point_x] input', tr).val(x);
    jQuery('td[data-field_name=point_y] input', tr).val(y);
  },

  update_metabox: function()
  {
    jQuery('#point_x').html(this.point_x);
    jQuery('#point_y').html(this.point_y);
  },

  move_marker_position: function()
  {
    jQuery('#marker').css({left: ProductsShow.point_x + '%', top: ProductsShow.point_y + '%'});
  },

  initialize: function()
  {
    var marker = "<div id='marker' class='marker'><i class='fa fa-plus'></i></div>";
    jQuery(function(){
      jQuery('#acf-image .has-image').append(marker);
      jQuery('img.acf-image-image').bind('click', function(e){
        var parentOffset = jQuery(this).parent().offset();
        var parentWidth = jQuery(this).parent().width();
        var parentHeight = jQuery(this).parent().height();

        ProductsShow.point_x = 100 * (e.pageX - parentOffset.left) / parentWidth;
        ProductsShow.point_y = 100 * (e.pageY - parentOffset.top) / parentHeight;
        ProductsShow.update_metabox();
        ProductsShow.move_marker_position();
      });

      jQuery('#acf-products .row').each(function(index, tr){
        var x = jQuery('td[data-field_name=point_x] input', tr).val();
        var y = jQuery('td[data-field_name=point_y] input', tr).val();
        var marker_id = "marker"+index;

        jQuery(tr).attr("data-marker", marker_id);
        ProductsShow.add_product_marker(marker_id, x, y);
      });

    });
  }
}

module.exports = ProductsShow;
});

require.register("___globals___", function(exports, require, module) {
  
});})();require('___globals___');


//# sourceMappingURL=admin.js.map
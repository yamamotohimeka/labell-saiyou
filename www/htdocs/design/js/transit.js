/*!
 * jQuery Transit - CSS3 transitions and transformations
 * (c) 2011-2012 Rico Sta. Cruz <rico@ricostacruz.com>
 * MIT Licensed.
 *
 * http://ricostacruz.com/jquery.transit
 * http://github.com/rstacruz/jquery.transit
 */

(function(k){k.transit={version:"0.9.9",propertyMap:{marginLeft:"margin",marginRight:"margin",marginBottom:"margin",marginTop:"margin",paddingLeft:"padding",paddingRight:"padding",paddingBottom:"padding",paddingTop:"padding"},enabled:true,useTransitionEnd:true};var d=document.createElement("div");var q={};function b(v){if(v in d.style){return v}var u=["Moz","Webkit","O","ms"];var r=v.charAt(0).toUpperCase()+v.substr(1);if(v in d.style){return v}for(var t=0;t<u.length;++t){var s=u[t]+r;if(s in d.style){return s}}}function e(){d.style[q.transform]="";d.style[q.transform]="rotateY(90deg)";return d.style[q.transform]!==""}var a=navigator.userAgent.toLowerCase().indexOf("chrome")>-1;q.transition=b("transition");q.transitionDelay=b("transitionDelay");q.transform=b("transform");q.transformOrigin=b("transformOrigin");q.transform3d=e();var i={transition:"transitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",WebkitTransition:"webkitTransitionEnd",msTransition:"MSTransitionEnd"};var f=q.transitionEnd=i[q.transition]||null;for(var p in q){if(q.hasOwnProperty(p)&&typeof k.support[p]==="undefined"){k.support[p]=q[p]}}d=null;k.cssEase={_default:"ease","in":"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)",easeOutCubic:"cubic-bezier(.215,.61,.355,1)",easeInOutCubic:"cubic-bezier(.645,.045,.355,1)",easeInCirc:"cubic-bezier(.6,.04,.98,.335)",easeOutCirc:"cubic-bezier(.075,.82,.165,1)",easeInOutCirc:"cubic-bezier(.785,.135,.15,.86)",easeInExpo:"cubic-bezier(.95,.05,.795,.035)",easeOutExpo:"cubic-bezier(.19,1,.22,1)",easeInOutExpo:"cubic-bezier(1,0,0,1)",easeInQuad:"cubic-bezier(.55,.085,.68,.53)",easeOutQuad:"cubic-bezier(.25,.46,.45,.94)",easeInOutQuad:"cubic-bezier(.455,.03,.515,.955)",easeInQuart:"cubic-bezier(.895,.03,.685,.22)",easeOutQuart:"cubic-bezier(.165,.84,.44,1)",easeInOutQuart:"cubic-bezier(.77,0,.175,1)",easeInQuint:"cubic-bezier(.755,.05,.855,.06)",easeOutQuint:"cubic-bezier(.23,1,.32,1)",easeInOutQuint:"cubic-bezier(.86,0,.07,1)",easeInSine:"cubic-bezier(.47,0,.745,.715)",easeOutSine:"cubic-bezier(.39,.575,.565,1)",easeInOutSine:"cubic-bezier(.445,.05,.55,.95)",easeInBack:"cubic-bezier(.6,-.28,.735,.045)",easeOutBack:"cubic-bezier(.175, .885,.32,1.275)",easeInOutBack:"cubic-bezier(.68,-.55,.265,1.55)"};k.cssHooks["transit:transform"]={get:function(r){return k(r).data("transform")||new j()},set:function(s,r){var t=r;if(!(t instanceof j)){t=new j(t)}if(q.transform==="WebkitTransform"&&!a){s.style[q.transform]=t.toString(true)}else{s.style[q.transform]=t.toString()}k(s).data("transform",t)}};k.cssHooks.transform={set:k.cssHooks["transit:transform"].set};if(k.fn.jquery<"1.8"){k.cssHooks.transformOrigin={get:function(r){return r.style[q.transformOrigin]},set:function(r,s){r.style[q.transformOrigin]=s}};k.cssHooks.transition={get:function(r){return r.style[q.transition]},set:function(r,s){r.style[q.transition]=s}}}n("scale");n("translate");n("rotate");n("rotateX");n("rotateY");n("rotate3d");n("perspective");n("skewX");n("skewY");n("x",true);n("y",true);function j(r){if(typeof r==="string"){this.parse(r)}return this}j.prototype={setFromString:function(t,s){var r=(typeof s==="string")?s.split(","):(s.constructor===Array)?s:[s];r.unshift(t);j.prototype.set.apply(this,r)},set:function(s){var r=Array.prototype.slice.apply(arguments,[1]);if(this.setter[s]){this.setter[s].apply(this,r)}else{this[s]=r.join(",")}},get:function(r){if(this.getter[r]){return this.getter[r].apply(this)}else{return this[r]||0}},setter:{rotate:function(r){this.rotate=o(r,"deg")},rotateX:function(r){this.rotateX=o(r,"deg")},rotateY:function(r){this.rotateY=o(r,"deg")},scale:function(r,s){if(s===undefined){s=r}this.scale=r+","+s},skewX:function(r){this.skewX=o(r,"deg")},skewY:function(r){this.skewY=o(r,"deg")},perspective:function(r){this.perspective=o(r,"px")},x:function(r){this.set("translate",r,null)},y:function(r){this.set("translate",null,r)},translate:function(r,s){if(this._translateX===undefined){this._translateX=0}if(this._translateY===undefined){this._translateY=0}if(r!==null&&r!==undefined){this._translateX=o(r,"px")}if(s!==null&&s!==undefined){this._translateY=o(s,"px")}this.translate=this._translateX+","+this._translateY}},getter:{x:function(){return this._translateX||0},y:function(){return this._translateY||0},scale:function(){var r=(this.scale||"1,1").split(",");if(r[0]){r[0]=parseFloat(r[0])}if(r[1]){r[1]=parseFloat(r[1])}return(r[0]===r[1])?r[0]:r},rotate3d:function(){var t=(this.rotate3d||"0,0,0,0deg").split(",");for(var r=0;r<=3;++r){if(t[r]){t[r]=parseFloat(t[r])}}if(t[3]){t[3]=o(t[3],"deg")}return t}},parse:function(s){var r=this;s.replace(/([a-zA-Z0-9]+)\((.*?)\)/g,function(t,v,u){r.setFromString(v,u)})},toString:function(t){var s=[];for(var r in this){if(this.hasOwnProperty(r)){if((!q.transform3d)&&((r==="rotateX")||(r==="rotateY")||(r==="perspective")||(r==="transformOrigin"))){continue}if(r[0]!=="_"){if(t&&(r==="scale")){s.push(r+"3d("+this[r]+",1)")}else{if(t&&(r==="translate")){s.push(r+"3d("+this[r]+",0)")}else{s.push(r+"("+this[r]+")")}}}}}return s.join(" ")}};function m(s,r,t){if(r===true){s.queue(t)}else{if(r){s.queue(r,t)}else{t()}}}function h(s){var r=[];k.each(s,function(t){t=k.camelCase(t);t=k.transit.propertyMap[t]||k.cssProps[t]||t;t=c(t);if(k.inArray(t,r)===-1){r.push(t)}});return r}function g(s,v,x,r){var t=h(s);if(k.cssEase[x]){x=k.cssEase[x]}var w=""+l(v)+" "+x;if(parseInt(r,10)>0){w+=" "+l(r)}var u=[];k.each(t,function(z,y){u.push(y+" "+w)});return u.join(", ")}k.fn.transition=k.fn.transit=function(z,s,y,C){var D=this;var u=0;var w=true;if(typeof s==="function"){C=s;s=undefined}if(typeof y==="function"){C=y;y=undefined}if(typeof z.easing!=="undefined"){y=z.easing;delete z.easing}if(typeof z.duration!=="undefined"){s=z.duration;delete z.duration}if(typeof z.complete!=="undefined"){C=z.complete;delete z.complete}if(typeof z.queue!=="undefined"){w=z.queue;delete z.queue}if(typeof z.delay!=="undefined"){u=z.delay;delete z.delay}if(typeof s==="undefined"){s=k.fx.speeds._default}if(typeof y==="undefined"){y=k.cssEase._default}s=l(s);var E=g(z,s,y,u);var B=k.transit.enabled&&q.transition;var t=B?(parseInt(s,10)+parseInt(u,10)):0;if(t===0){var A=function(F){D.css(z);if(C){C.apply(D)}if(F){F()}};m(D,w,A);return D}var x={};var r=function(H){var G=false;var F=function(){if(G){D.unbind(f,F)}if(t>0){D.each(function(){this.style[q.transition]=(x[this]||null)})}if(typeof C==="function"){C.apply(D)}if(typeof H==="function"){H()}};if((t>0)&&(f)&&(k.transit.useTransitionEnd)){G=true;D.bind(f,F)}else{window.setTimeout(F,t)}D.each(function(){if(t>0){this.style[q.transition]=E}k(this).css(z)})};var v=function(F){this.offsetWidth;r(F)};m(D,w,v);return this};function n(s,r){if(!r){k.cssNumber[s]=true}k.transit.propertyMap[s]=q.transform;k.cssHooks[s]={get:function(v){var u=k(v).css("transit:transform");return u.get(s)},set:function(v,w){var u=k(v).css("transit:transform");u.setFromString(s,w);k(v).css({"transit:transform":u})}}}function c(r){return r.replace(/([A-Z])/g,function(s){return"-"+s.toLowerCase()})}function o(s,r){if((typeof s==="string")&&(!s.match(/^[\-0-9\.]+$/))){return s}else{return""+s+r}}function l(s){var r=s;if(k.fx.speeds[r]){r=k.fx.speeds[r]}return o(r,"ms")}k.transit.getTransitionValue=g})(jQuery);

//slider
(function() {
  var Slide;

  Slide = (function() {
    function Slide(node, duration) {
      this.count = 0;
      this.xx = false;
      this.baseDuration = duration | 420;
      this.$node = $(node);
      this.$container = this.$node.find('.slide-container');
      this.$items = this.$node.find('.slide-item');
      this.$navs = this.$node.find('.slide-navigation > *');
      this.index = this.$items.length * 100;
      this.$currentItem = this.$items.eq(this.getIndex(this.index));
      this.windowUpdate();
      this.init();
      this.setEvent();
      this.loop();
    }

    Slide.prototype.getIndex = function(index) {
      return index % this.$items.length | 0;
    };

    Slide.prototype.init = function() {
      var $items, initAnm, navIndex,
        _this = this;
      if (this.$items.length < 3) {
        $items = this.$items.clone();
        this.$container.append($items);
        this.$items = this.$node.find('.slide-item');
        this.xx = true;
      }
      this.relativePos = {
        x: 0,
        y: 0
      };
      this.set();
      navIndex = this.xx ? this.getIndex(this.index) % 2 : this.getIndex(this.index);
      this.$navs.eq(navIndex).addClass('current');
      this.$items.eq(this.getIndex(this.index)).css({
        scale: 1.2,
        opacity: 0,
        x: -20,
        y: 20
      });
      return (initAnm = function() {
        return setTimeout(function() {
          if (0 < _this.$node.find('img').eq(_this.$items.length - 1).height()) {
            return setTimeout(function() {
              _this.$node.css({
                backgroundImage: 'none'
              });
              return _this.$items.eq(_this.getIndex(_this.index)).css({
                scale: 1,
                opacity: 1,
                x: 0,
                y: 0
              });
            }, 100);
          } else {
            return initAnm();
          }
        }, 200);
      })();
    };

    Slide.prototype.windowUpdate = function() {
      return this.windowWidth = $(window).width();
    };

    Slide.prototype.loop = function() {
      var _this = this;
      this.count++;
      if (this.count > 4) {
        this.posInit();
        this.count = 0;
        setTimeout(function() {
          return _this.move(1);
        }, 150);
      }
      return setTimeout(function() {
        return _this.loop();
      }, 1000);
    };

    Slide.prototype.posInit = function() {
      this.count = 0;
      this.$items.addClass('active');
      this.$items.eq(this.getIndex(this.index - 1)).css({
        x: -this.windowWidth,
        zIndex: 2
      });
      this.$items.eq(this.getIndex(this.index + 1)).css({
        x: this.windowWidth,
        zIndex: 2
      });
      this.$items.eq(this.getIndex(this.index)).css({
        x: 0,
        zIndex: 1
      });
      return this.relativePos = {
        x: 0,
        y: 0
      };
    };

    Slide.prototype.set = function() {
      this.count = 0;
      this.$items.eq(this.getIndex(this.index - 1)).css({
        x: -this.windowWidth + this.relativePos.x
      });
      this.$items.eq(this.getIndex(this.index + 1)).css({
        x: this.windowWidth + this.relativePos.x
      });
      return this.$items.eq(this.getIndex(this.index)).css({
        x: this.relativePos.x
      });
    };

    Slide.prototype.move = function(n) {
      var duration, navIndex;
      this.count = 0;
      this.$items.removeClass('active');
      duration = this.baseDuration * (1 - Math.abs(this.$items.eq(this.getIndex(this.index)).offset().left) / this.windowWidth);
      this.index += n;
      this.$items.eq(this.getIndex(this.index)).css({
        x: 0
      });
      this.$items.eq(this.getIndex(this.index - n)).css({
        x: this.windowWidth * -n
      });
      this.$navs.removeClass('current');
      navIndex = this.xx ? this.getIndex(this.index) % 2 : this.getIndex(this.index);
      return this.$navs.eq(navIndex).addClass('current');
    };

    Slide.prototype.moveCanvel = function() {
      var duration;
      this.count = 0;
      this.$items.removeClass('active');
      duration = this.baseDuration * (1 - Math.abs(this.$items.eq(this.getIndex(this.index)).offset().left) / this.windowWidth);
      this.$items.eq(this.getIndex(this.index + 1)).css({
        x: this.windowWidth
      });
      this.$items.eq(this.getIndex(this.index)).css({
        x: 0
      });
      return this.$items.eq(this.getIndex(this.index - 1)).css({
        x: -this.windowWidth
      });
    };

    Slide.prototype.setEvent = function() {
      var _this = this;
      return this.$node.on({
        touchstart: function() {
          return _this.touchStart(event);
        },
        touchmove: function() {
          return _this.touchMove(event);
        },
        touchend: function() {
          return _this.touchEnd(event);
        }
      });
    };

    Slide.prototype.touchStart = function(event) {
      this.posInit();
      this.direct = false;
      return this.touchStartPos = {
        x: event.changedTouches[0].pageX,
        y: event.changedTouches[0].pageY
      };
    };

    Slide.prototype.touchMove = function(event) {
      this.touchMovePos = {
        x: event.changedTouches[0].pageX,
        y: event.changedTouches[0].pageY
      };
      this.relativePos = {
        x: this.touchMovePos.x - this.touchStartPos.x,
        y: this.touchMovePos.y - this.touchStartPos.y
      };
      if (!this.direct) {
        if (5 < Math.abs(this.relativePos.y)) {
          this.direct = 'top';
        }
        if (5 < Math.abs(this.relativePos.x)) {
          this.direct = 'left';
        }
      }
      if (this.direct === 'left') {
        event.preventDefault();
        this.scrollFlag = false;
        return this.set();
      }
    };

    Slide.prototype.touchEnd = function(event) {
      if (this.direct === 'left') {
        if (15 < this.relativePos.x) {
          this.move(-1);
        }
        if (-15 > this.relativePos.x) {
          this.move(1);
        }
        if (16 > Math.abs(this.relativePos.x)) {
          this.moveCanvel();
        }
        if (!(5 > Math.abs(this.relativePos.x) && 5 > Math.abs(this.relativePos.y))) {
          return event.preventDefault();
        }
      } else {
        return this.moveCanvel();
      }
    };

    return Slide;

  })();

  $.fn.extend({
    transitSlide: function() {
      return new Slide(this);
    }
  });

  $(function() {
    return $('body').find('.ui-slide').each(function() {
      return $(this).transitSlide();
    });
  });

}).call(this);
(function() {
  var Slide;

  Slide = (function() {
    function Slide(node, duration) {
      this.count = 0;
      this.xx = false;
      this.baseDuration = duration | 420;
      this.$node = $(node);
      this.$container = this.$node.find('.slide-container');
      this.$items = this.$node.find('.slide-item');
      this.$navs = this.$node.find('.slide-navigation > *');
      this.index = this.$items.length * 100;
      this.$currentItem = this.$items.eq(this.getIndex(this.index));
      this.windowUpdate();
      this.init();
      this.setEvent();
      this.loop();
    }

    Slide.prototype.getIndex = function(index) {
      return index % this.$items.length | 0;
    };

    Slide.prototype.init = function() {
      var $items, initAnm, navIndex,
        _this = this;
      if (this.$items.length < 3) {
        $items = this.$items.clone();
        this.$container.append($items);
        this.$items = this.$node.find('.slide-item');
        this.xx = true;
      }
      this.relativePos = {
        x: 0,
        y: 0
      };
      this.set();
      navIndex = this.xx ? this.getIndex(this.index) % 2 : this.getIndex(this.index);
      this.$navs.eq(navIndex).addClass('current');
      this.$items.eq(this.getIndex(this.index)).css({
        scale: 1.2,
        opacity: 0,
        x: -20,
        y: 20
      });
      return (initAnm = function() {
        return setTimeout(function() {
          if (0 < _this.$node.find('img').eq(_this.$items.length - 1).height()) {
            return setTimeout(function() {
              _this.$node.css({
                backgroundImage: 'none'
              });
              return _this.$items.eq(_this.getIndex(_this.index)).css({
                scale: 1,
                opacity: 1,
                x: 0,
                y: 0
              });
            }, 100);
          } else {
            return initAnm();
          }
        }, 200);
      })();
    };

    Slide.prototype.windowUpdate = function() {
      return this.windowWidth = $(window).width();
    };

    Slide.prototype.loop = function() {
      var _this = this;
      this.count++;
      if (this.count > 4) {
        this.posInit();
        this.count = 0;
        setTimeout(function() {
          return _this.move(1);
        }, 150);
      }
      return setTimeout(function() {
        return _this.loop();
      }, 1000);
    };

    Slide.prototype.posInit = function() {
      this.count = 0;
      this.$items.addClass('active');
      this.$items.eq(this.getIndex(this.index - 1)).css({
        x: -this.windowWidth,
        zIndex: 2
      });
      this.$items.eq(this.getIndex(this.index + 1)).css({
        x: this.windowWidth,
        zIndex: 2
      });
      this.$items.eq(this.getIndex(this.index)).css({
        x: 0,
        zIndex: 1
      });
      return this.relativePos = {
        x: 0,
        y: 0
      };
    };

    Slide.prototype.set = function() {
      this.count = 0;
      this.$items.eq(this.getIndex(this.index - 1)).css({
        x: -this.windowWidth + this.relativePos.x
      });
      this.$items.eq(this.getIndex(this.index + 1)).css({
        x: this.windowWidth + this.relativePos.x
      });
      return this.$items.eq(this.getIndex(this.index)).css({
        x: this.relativePos.x
      });
    };

    Slide.prototype.move = function(n) {
      var duration, navIndex;
      this.count = 0;
      this.$items.removeClass('active');
      duration = this.baseDuration * (1 - Math.abs(this.$items.eq(this.getIndex(this.index)).offset().left) / this.windowWidth);
      this.index += n;
      this.$items.eq(this.getIndex(this.index)).css({
        x: 0
      });
      this.$items.eq(this.getIndex(this.index - n)).css({
        x: this.windowWidth * -n
      });
      this.$navs.removeClass('current');
      navIndex = this.xx ? this.getIndex(this.index) % 2 : this.getIndex(this.index);
      return this.$navs.eq(navIndex).addClass('current');
    };

    Slide.prototype.moveCanvel = function() {
      var duration;
      this.count = 0;
      this.$items.removeClass('active');
      duration = this.baseDuration * (1 - Math.abs(this.$items.eq(this.getIndex(this.index)).offset().left) / this.windowWidth);
      this.$items.eq(this.getIndex(this.index + 1)).css({
        x: this.windowWidth
      });
      this.$items.eq(this.getIndex(this.index)).css({
        x: 0
      });
      return this.$items.eq(this.getIndex(this.index - 1)).css({
        x: -this.windowWidth
      });
    };

    Slide.prototype.setEvent = function() {
      var _this = this;
      return this.$node.on({
        touchstart: function() {
          return _this.touchStart(event);
        },
        touchmove: function() {
          return _this.touchMove(event);
        },
        touchend: function() {
          return _this.touchEnd(event);
        }
      });
    };

    Slide.prototype.touchStart = function(event) {
      this.posInit();
      this.direct = false;
      return this.touchStartPos = {
        x: event.changedTouches[0].pageX,
        y: event.changedTouches[0].pageY
      };
    };

    Slide.prototype.touchMove = function(event) {
      this.touchMovePos = {
        x: event.changedTouches[0].pageX,
        y: event.changedTouches[0].pageY
      };
      this.relativePos = {
        x: this.touchMovePos.x - this.touchStartPos.x,
        y: this.touchMovePos.y - this.touchStartPos.y
      };
      if (!this.direct) {
        if (5 < Math.abs(this.relativePos.y)) {
          this.direct = 'top';
        }
        if (5 < Math.abs(this.relativePos.x)) {
          this.direct = 'left';
        }
      }
      if (this.direct === 'left') {
        event.preventDefault();
        this.scrollFlag = false;
        return this.set();
      }
    };

    Slide.prototype.touchEnd = function(event) {
      if (this.direct === 'left') {
        if (15 < this.relativePos.x) {
          this.move(-1);
        }
        if (-15 > this.relativePos.x) {
          this.move(1);
        }
        if (16 > Math.abs(this.relativePos.x)) {
          this.moveCanvel();
        }
        if (!(5 > Math.abs(this.relativePos.x) && 5 > Math.abs(this.relativePos.y))) {
          return event.preventDefault();
        }
      } else {
        return this.moveCanvel();
      }
    };

    return Slide;

  })();

  $.fn.extend({
    transitSlide: function() {
      return new Slide(this);
    }
  });

  $(function() {
    return $('body').find('.ui-slide').each(function() {
      return $(this).transitSlide();
    });
  });

}).call(this);


//snsbtn
(function() {
  $.fn.extend({
    toggleOverlay: function() {
      return $(this).find('.toggle-overlay').each(function() {
        var $btn, $target, $this, $time;
        $this = $(this);
        $btn = $this.find('.overlay-btn');
        $target = $this.find('.overlay-target');
        $time = $this.attr('data-overlay-duration') | 300;
        $target.css({
          backfaceVisibility: 'hidden',
          transformStyle: 'preserve-3d',
          transitionPrpperty: 'opacity',
          transitionDuration: 2000,
          transitionTimingFunction: "cubic-bezier(0.455, 0.03, 0.515, 0.955)"
        });
        $this.on({
          click: function() {
            return $this.removeClass('hide');
          }
        });
        return $target.on({
          click: function() {
            $this.addClass('hide');
            return false;
          }
        });
      });
    }
  });

  $(function() {
    return $('body').toggleOverlay();
  });

}).call(this);

(function() {
  var ShareButtons;

  ShareButtons = (function() {
    ShareButtons.html = '<nav id="share-buttons">\n  <ul>\n    <li class="twitter s-btn"><a href="#" target="_blank"><img src="images/menu_1.png"></a></li>\n    <li class="facebook s-btn"><a href="#"><img src="images/menu_2.png" style="border:none;"></a></li>\n    <li class="instagram s-btn"><a href="#"><img src="images/menu_3.png"></a></li>\n    <li class="checkup s-btn"><a href="#"><img src="images/menu_4.png"></a></li>\n  <li class="mail s-btn"><a href="#"><img src="images/menu_5.png"></a></li>\n　</ul>\n\n  <a class="btn-switch">\n    <div class="open show"><img src="images/burger.png"></div>\n    <div class="close hide"><img src="images/burger.png"></div>\n  </a>\n</nav>';

    function ShareButtons() {
      var _this = this;
      this.isAndroid = false;
      if (navigator.userAgent.toLowerCase().indexOf('android') > 0) {
        this.isAndroid = true;
      }
      this.isIPhone = false;
      if (navigator.userAgent.toLowerCase().indexOf('iphone') > 0) {
        this.isIPhone = true;
      }
      this.$target = $(ShareButtons.html);
      this.isShown = false;
      this.isAnimating = false;
      this.isSBtnShown = false;
      this.isAddEvents = false;
      this.$lists = this.$target.find('.s-btn');
      this.$btnContainer = this.$target.find('>ul');
      this.$btnContainer.css({
        position: 'relative'
      });
      this.list = [];
      this.$lists.each(function(i, t) {
        return _this.list.push($(t));
      });
      this.$btnSwitch = this.$target.find('.btn-switch');
      this.$btnSwitchOpen = this.$btnSwitch.find('.open');
      this.$btnSwitchClose = this.$btnSwitch.find('.close');
      this.$btnSwitch.on({
        click: function() {
          if (_this.isShown) {
            _this.hide();
          } else {
            _this.show();
          }
          return false;
        }
      });
      this.$target.on({
        touchmove: function() {
          return false;
        }
      });
      this.ready();
      this.$footerGlobal = $('footer.global');
    }

    ShareButtons.prototype.ready = function() {
      var btnImgURL, count, imgs, num, _onLoad,
        _this = this;
      $('body').append(this.$target);
      imgs = this.$target.find('img');
      btnImgURL = this.$btnSwitch.css('background-image').match(/https?:\/\/[-_.!~*'()a-zA-Z0-9;\/?:@&=+$,%#]+[a-z]/g);
      if (btnImgURL && btnImgURL.length) {
        btnImgURL = btnImgURL[0];
      } else {
        btnImgURL = null;
      }
      num = imgs.length;
      count = 0;
      _onLoad = function(e) {
        var img;
        $(e.target).off('load');
        count += 1;
        if (count >= num) {
          if (btnImgURL) {
            img = $('<img>');
            img.attr('src', btnImgURL);
            return img.on({
              load: function() {
                img.off('load');
                return _this.onReady();
              }
            });
          } else {
            return _this.onReady();
          }
        }
      };
      return imgs.each(function(i, target) {
        return $(target).on({
          load: function(e) {
            return _onLoad(e);
          },
          error: function(e) {
            return _onLoad(e);
          }
        });
      });
    };

    ShareButtons.prototype.showBtn = function() {
      var _this = this;
      if (this.isSBtnShown) {
        return;
      }
      this.isSBtnShown = true;
      return setTimeout(function() {
        _this.$btnSwitch.addClass('show');
        return _this.addEventListeners();
      }, 300);
    };

    ShareButtons.prototype.hideBtn = function() {
      if (!this.isSBtnShown) {
        return;
      }
      this.isSBtnShown = false;
      return this.$btnSwitch.removeClass('show');
    };

    ShareButtons.prototype.addEventListeners = function() {
      var _this = this;
      if (this.isAddEvents) {
        return;
      }
      this.isAddEvents = true;
      $('body').on({
        touchmove: function() {
          return _this.onScroll();
        },
        touchend: function() {
          return _this.onScroll();
        }
      });
      return $(window).on({
        scroll: function() {
          return _this.onScroll();
        }
      });
    };

    ShareButtons.prototype.onScroll = function() {
      var _this = this;
      if ($(window).scrollTop() + $(window).height() < this.$footerGlobal.offset().top + 100) {
        if (this.scrollIntervalId) {
          clearInterval(this.scrollIntervalId);
        }
        return this.scrollIntervalId = setTimeout(function() {
          return _this.showBtn();
        }, 100);
      } else {
        if (this.scrollIntervalId) {
          clearInterval(this.scrollIntervalId);
        }
        return this.hideBtn();
      }
    };

    ShareButtons.prototype.show = function() {
      if (this.isShown) {
        return;
      }
      if (this.isAnimating) {
        return;
      }
      this.isShown = true;
      this.isAnimating = true;
      this.$lists.off('webkitTransitionEnd');
      this.$target.removeClass('close').addClass('open');
      this.showButton();
      this.showBg();
      this.$btnSwitchOpen.removeClass('show').addClass('hide');
      return this.$btnSwitchClose.removeClass('hide').addClass('show');
    };

    ShareButtons.prototype.hide = function() {
      if (!this.isShown) {
        return;
      }
      if (this.isAnimating) {
        return;
      }
      this.isShown = false;
      this.isAnimating = true;
      this.$target.removeClass('open').addClass('close');
      this.$lists.off('webkitTransitionEnd');
      this.hideButton();
      this.hideBg();
      this.$btnSwitchOpen.removeClass('hide').addClass('show');
      return this.$btnSwitchClose.removeClass('show').addClass('hide');
    };

    ShareButtons.prototype.showBg = function() {
      var _this = this;
      if (!this.$bg) {
        this.$bg = $('<div>');
        this.$bg.addClass('share-buttons-bg');
        $('body').append(this.$bg);
        if (this.isIPhone) {
          this.$bg.addClass('iphone');
        }
      }
      this.$bg.on({
        touchstart: function(e) {
          e.preventDefault();
          e.stopPropagation();
          return false;
        },
        touchmove: function() {
          return false;
        },
        click: function(e) {
          e.preventDefault();
          e.stopPropagation();
          return false;
        },
        touchend: function(e) {
          e.preventDefault();
          e.stopPropagation();
          _this.hide();
          return false;
        }
      });
      if (this.isAndroid) {
        return this.$bg.removeClass('hide').addClass('show');
      } else {
        return setTimeout(function() {
          return _this.$bg.removeClass('hide').addClass('show');
        }, 10);
      }
    };

    ShareButtons.prototype.hideBg = function() {
      var _this = this;
      this.$bg.off('webkitTransitionEnd');
      this.$bg.off('touchstart');
      this.$bg.off('touchmove');
      this.$bg.off('touchend');
      this.$bg.off('click');
      this.$bg.off('webkitTransitionEnd');
      this.$bg.on({
        webkitTransitionEnd: function() {
          _this.$bg.remove();
          return _this.$bg = null;
        }
      });
      this.$bg.removeClass('show').addClass('hide');
      if (!this.isIPhone) {
        return setTimeout(function() {
          _this.$bg.remove();
          return _this.$bg = null;
        }, 500);
      }
    };

    ShareButtons.prototype.showButton = function() {
      var listClone, _showButton, _showButtonDelay,
        _this = this;
      listClone = this.list.concat();
      listClone.reverse();
      _showButtonDelay = function() {
        return setTimeout(function() {
          return _showButton();
        }, 50);
      };
      _showButton = function() {
        var t;
        t = listClone.shift();
        t.removeClass('hide').addClass('show');
        if (listClone.length) {
          return _showButtonDelay();
        } else {
          return t.on({
            webkitTransitionEnd: function(e) {
              $(e.target).off('webkitTransitionEnd');
              return _this.onShow();
            }
          });
        }
      };
      return _showButton();
    };

    ShareButtons.prototype.hideButton = function() {
      var listClone, _hideButton, _hideButtonDelay,
        _this = this;
      listClone = this.list.concat();
      _hideButtonDelay = function() {
        return setTimeout(function() {
          return _hideButton();
        }, 50);
      };
      _hideButton = function() {
        var t;
        t = listClone.shift();
        t.removeClass('show').addClass('hide');
        if (listClone.length) {
          return _hideButtonDelay();
        } else {
          return t.on({
            webkitTransitionEnd: function(e) {
              $(e.target).off('webkitTransitionEnd');
              return _this.onHide();
            }
          });
        }
      };
      return _hideButton();
    };

    ShareButtons.prototype.onShow = function() {
      return this.isAnimating = false;
    };

    ShareButtons.prototype.onHide = function() {
      return this.isAnimating = false;
    };

    ShareButtons.prototype.onReady = function() {
      $('body').append(this.$target);
      return this.showBtn();
    };

    return ShareButtons;

  })();

  $(function() {
    var checkAndroid;
    checkAndroid = function(n) {
      var bo, ua, version;
      bo = false;
      ua = navigator.userAgent.toLowerCase();
      version = ua.substr(ua.indexOf('android') + 8, 3);
      if (ua.indexOf("android") > 0) {
        if (parseFloat(version) < n) {
          bo = true;
        }
      }
      return bo;
    };
    if (!checkAndroid(3)) {
      return window.sb = new ShareButtons();
    }
  });

}).call(this);
(function() {
  $.fn.extend({
    sidi: function(path) {
      var $sidContainer, $wrapContainer, sidiToggle,
        _this = this;
      if (!window.isSidi) {
        window.sidiOpen = false;
        window.isSidi = true;
        $sidContainer = $('<div id="scroll_wrapper" class="sidi-container">');
        $wrapContainer = $('<div class="body-container">');
        $(this).wrapInner($wrapContainer);
        $.get(path, function(data) {
          $sidContainer.append(data);
          $sidContainer.appendTo(_this);
          return $.get('/sp/mt/navigation.html', function(data) {
            $('#sidi_news').append(data);
            return $sidContainer.toggleAccordion();
          });
        });
        sidiToggle = function() {
          $('html').toggleClass('sidi-open', window.sidiOpen);
          return $('html').toggleClass('sidi-close', !window.sidiOpen);
        };
        $(window).on({
          'sidi:toggle': function() {
            window.sidiOpen = !window.sidiOpen;
            return sidiToggle();
          },
          'sidi:open': function() {
            window.sidiOpen = true;
            return sidiToggle();
          },
          'sidi:close': function() {
            window.sidiOpen = false;
            return sidiToggle();
          }
        });
      }
      return $('.body-container').on({
        touchmove: function() {
          if (window.sidiOpen) {
            $(window).trigger('sidi:close');
            return event.preventDefault();
          }
        },
        touchstart: function() {
          if (window.sidiOpen) {
            $(window).trigger('sidi:close');
            return event.preventDefault();
          }
        }
      });
    }
  });

}).call(this);
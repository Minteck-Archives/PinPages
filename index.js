function validateToken() {
    ssldata = new FormData()
    ssldata.append("token", document.cookie.substr(6))
    request = "/library/validate_token.php"

    $.ajax({
        url: request,
        dataType: 'html',
        cache: false,
        data: ssldata,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (data) {
            if (data == "True") {
                location.href = "/app/?lang=" + langprop
            }
        }})
}

let options = {
    root: document.body,
    rootMargin: '0px',
    threshold: .1
}

let intersectionCallback = () => {
    console.log("HANDLE INTERSECT")
}

function viewable(el) {
        // INIT
        el = $(el);
        var scroll = document.viewport.getScrollOffsets();
        var viewport = document.viewport.getDimensions();
        var offsets = el.cumulativeOffset();
        var dimensions = el.getDimensions();
      
        // Sanity check
        if (el.getStyle('display') == 'none' || el.getStyle('visibility') == 'hidden') return 0;
      
        // Fix offsets based on scroll
        offsets.top = offsets.top - scroll.top;
        offsets.left = offsets.left - scroll.left;
      
        // Build visible dimensions
        var visible_dimensions = {width: dimensions.width, height: dimensions.height};
      
        // Top
        if (offsets.top < 0) {
            if (Math.abs(offsets.top) > dimensions.height) return 0; // Sanity check
            else {
                visible_dimensions.height -= Math.abs(offsets.top);
            }
        }
      
        // Left
        if (offsets.left < 0) {
            if (Math.abs(offsets.left) > dimensions.width) return 0; // Sanity check
            else {
                visible_dimensions.width -= Math.abs(offsets.left);
            }
        }
      
        // Bottom
        var bottomPos = offsets.top + dimensions.height;
        if (bottomPos > viewport.height) {
            var diff = bottomPos - viewport.height;
            if (diff > dimensions.height) return 0; // Sanity check
            else {
                visible_dimensions.height -= diff;
            }
        }
      
        // Right
        var rightPos = offsets.left + dimensions.width;
        if (rightPos > viewport.width) {
            var diff = rightPos - viewport.width;
            if (diff > dimensions.width) return 0; // Sanity check
            else {
                visible_dimensions.width -= diff;
            }
        }
      
        // Return
        return (visible_dimensions.width * visible_dimensions.height) / (dimensions.width * dimensions.height);
    }

// let observer = new IntersectionObserver(intersectionCallback, options);
// observer.observe(document.querySelector(".reveal"));

window.addEventListener('scroll', e => {
    console.log("Scroll");
    console.log("Scroll: " + calculateVisibilityForDiv(document.querySelectorAll(".reveal")))
})

'use strict';
var results = {};

function calculateVisibilityForDiv(div) {
// debugger;
div = div[0];

  var windowHeight = window.innerWidth || document.documentElement.clientWidth,
    docScroll = window.scrollTop || document.body.scrollTop,
    divPosition = div.offsetTop,
  divHeight = div.offsetHeight || div.clientHeight,
    hiddenBefore = docScroll - divPosition,
    hiddenAfter = (divPosition + divHeight) - (docScroll + windowHeight);

  if ((docScroll > divPosition + divHeight) || (divPosition > docScroll + windowHeight)) {
    return 0;
  } else {
    var result = 100;

    if (hiddenBefore > 0) {
      result -= (hiddenBefore * 100) / divHeight;
    }

    if (hiddenAfter > 0) {
      result -= (hiddenAfter * 100) / divHeight;
    }

    return result;
  }
}

var getOffset = function(elem) {
  var box = {
    top: 0,
    left: 0
  };
  if (typeof elem.getBoundingClientRect !== "undefined") box = elem.getBoundingClientRect();
  return {
    x: box.left + (window.pageXOffset || document.scrollLeft || 0) - (document.clientLeft || 0),
    y: box.top + (window.pageYOffset || document.scrollTop || 0) - (document.clientTop || 0)
  };
};
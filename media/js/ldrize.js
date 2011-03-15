$(function() {

  var keyconfig = (function() {

    var entries,
        currentIndex = 0,
        pinBuffer = [];

    var keys = {74: 'j', 75: 'k', 79: 'o', 80: 'p', 88: 'x', 83: 's', 68: 'd', 65: 'a', 191: '/'};
    var funcMap = {
      'j' : next,
      'k' : prev,
      'p' : pin,
      'o' : open,
      'x' : check,
      'd' : remove,
      's' : verify,
      'a' : approve,
      '/' : help
    };

    function initialize() {
      entries = $('div.table-holder tbody tr');
      $(document).bind('keydown', function(e) {
        if (e.currentTarget.activeElement.tagName === 'INPUT') {
          return;
        }
        var fireFn = funcMap[keys[e.keyCode]];
        if (fireFn) {
          fireFn();
          e.preventDefault();
          return false;
        }
      });
      focusEntry(true);
    }


    function next() {
      if (entries.get(currentIndex + 1)) {
        currentIndex++;
        focusEntry();
      }
    }

    function prev() {
      if (entries.get(currentIndex - 1)) {
        currentIndex--;
        focusEntry();
      } else {
        if (currentIndex === 0) {
          currentIndex--;
          $('html, body').animate({
            scrollTop: 0
          }, 200);
        }
      }
    }

    function pin() {
      check();
      next();
    }

    function open() {
      var currentUrl = window.location.href;
      var checkboxes = $('div.table-holder input[type=checkbox]');
      checkboxes.each(function(idx, cb) {
        if ($(cb).is(':checked')) {
          window.open(currentUrl + '/edit/' + $(cb).val());
        }
      });
    }

    function help() {
      alert('a: \u627F\u8A8D, s: \u691C\u8A3C, d: \u524A\u9664\n' + 
            'x: \u30C1\u30A7\u30C3\u30AF\u3092\u5165\u308C\u308B\n' + 
            'p: \u30C1\u30A7\u30C3\u30AF\u3092\u5165\u308C\u3066\u6B21\u3078\n' + 
            'o: \u30C1\u30A7\u30C3\u30AF\u3092\u5165\u308C\u305F\u7269\u3092\u5168\u3066\u958B\u304F');
    }

    function check() {
      var target = $(entries.get(currentIndex)).children('td').children('input[type=checkbox]');  
      var check = !target.attr('checked');
      target.attr('checked', check);
      if (check) {
        $(entries.get(currentIndex)).addClass('selected');
      } else {
        $(entries.get(currentIndex)).removeClass('selected');
      }
    }

    function remove() {
      if (checkMultiple()) {
        reportAction('d', 'DELETE', '');
      } else {
        var reportId = getReportId();
        reportAction('d', 'DELETE', reportId);
      }
    }

    function verify() {
      if (checkMultiple()) {
        reportAction('v', 'VERIFY', '');
      } else {
        var reportId = getReportId();
        reportAction('v', 'VERIFY', reportId);
      }
    }

    function approve() {
      if (checkMultiple()) {
        reportAction('a', 'APPROVE', '');
      } else {
        var reportId = getReportId();
        reportAction('a', 'APPROVE', reportId);
      }
    }

    function checkMultiple() {
      var nums = 0;
      var checkboxes = $('div.table-holder input[type=checkbox]');
      checkboxes.each(function(idx, cb) {
        if ($(cb).is(':checked')) {
          nums++;
        }
      });
      return nums > 1;
    }

    function getReportId() {
      return $(entries.get(currentIndex)).children('td').children('input[type=checkbox]').val();  
    }

    function focusEntry(noAnimation) {
      // focus new target
      var target = $(entries.get(currentIndex));  
      if (!noAnimation) {
        $('html, body').stop();
        $('html, body').animate({
          scrollTop: target.offset().top - 10
        }, jQuery.browser.opera ? 0 : 200);
      }
    }

    return {
      initialize : initialize
    }
  })();
  keyconfig.initialize();

});

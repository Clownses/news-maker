;(function ($) {
  $.fn.AjaxFileUpload = function (options) {
    var defaults = {
          action:     'upload.php',
          onChange:   function (filename) {},
          onSubmit:   function (filename) {},
          onComplete: function (filename, response) {}
        },
        settings = $.extend({}, defaults, options),
        randomId = (function () {
          var id = 0;
          return function () {
            return '_AjaxFileUpload' + id++;
          };
        })();

    return this.each(function () {
      var $this = $(this);
      if ($this.is('input') && $this.attr('type') === 'file') {
        $this.bind('change', onChange);
      }
    });

    function onChange (e) {
      var $element = $(e.target),
          id       = $element.attr('id'),
          $clone   = $element.removeAttr('id').clone().attr('id', id).AjaxFileUpload(options),
          filename = $element.val().replace(/.*(\/|\\)/, ''),
          iframe   = createIframe(),
          form     = createForm(iframe);

      $clone.insertBefore($element);

      settings.onChange.call($clone[0], filename);

      iframe.bind('load', {element: $clone, form: form, filename: filename}, onComplete);

      form.append($element).bind('submit', {element: $clone, iframe: iframe, filename: filename}, onSubmit).submit();
    }

    function onSubmit (e) {
      var data = settings.onSubmit.call(e.data.element, e.data.filename);

      if (data === false) {
        $(e.target).remove();
        e.data.iframe.remove();
        return false;
      } else {
        for (var variable in data) {
          $('<input />')
            .attr('type', 'hidden')
            .attr('name', variable)
            .val(data[variable])
            .appendTo(e.target);
        }
      }
    }

    function onComplete (e) {
      var $iframe  = $(e.target),
          doc      = ($iframe[0].contentWindow || $iframe[0].contentDocument).document,
          response = doc.body.innerHTML;

      if (response) {
        response = $.parseJSON(response);
      } else {
        response = {};
      }

      settings.onComplete.call(e.data.element, e.data.filename, response);

      e.data.form.remove();
      $iframe.remove();
    }

    function createIframe () {
      var id = randomId();

      $('body').append('<iframe src="javascript:false;" name="' + id + '" id="' + id + '" style="display: none;"></iframe>');

      return $('#' + id);
    }

    function createForm (iframe) {
      return $('<form />')
        .attr({
          method:  'post',
          action:  settings.action,
          enctype: 'multipart/form-data',
          target:  iframe[0].name
        })
        .hide()
        .appendTo('body');
    }
  };
})(jQuery);
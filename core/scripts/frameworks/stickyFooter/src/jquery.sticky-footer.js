/**
 * @param {Object} $ The jQuery library
 */
(function($) {

  /**
   * Defines a jQuery object method called stickyFooter to position a footer at the bottom of the page.
   *
   * @param {string} action Specifies whether to create or destroy the sticky footer. If the action is other than 'destroy'
   * then some styles will be applied to the document so the footer always sticks to the bottom of the page; it's the default behaviour
   * and you can omit the plugin parameter. Otherwise, if the action is 'destroy', the styles applied by the plugin will be reset
   * to their default values and the footer will assume its default befaviour - it will stick to page content
   *
   * @return {selector}
   */
  $.fn.stickyFooter = function(action) {
    return this.each(function() {
      if (action === 'destroy') {
        $('html, body').removeClass('is-sticky-footer-enabled');
        $(this).removeAttr('data-sticky-footer');
        $.fn.stickyFooter.stickyFooterStyle.remove();
      }
      else {
        var footerHeight = $(this).outerHeight(true);
        if ($('html').hasClass('is-sticky-footer-enabled')) {
          $.fn.stickyFooter.stickyFooterStyle.remove();
        }
        $(this).parents().height('100%');
        $(this).siblings().addClass('sticky-footer-sibling');
        // Inject style tag and save a reference to it so it can be removed on footer destruction
        $.fn.stickyFooter.stickyFooterStyle = $(
          '<style type="text/css">' +
          'html.is-sticky-footer-enabled > body .sticky-footer-sibling {' +
              'margin-bottom: -' + footerHeight + 'px' +
          '}' +
          'html.is-sticky-footer-enabled > body .sticky-footer-sibling::after {' +
              'height: ' + footerHeight + 'px' +
          '}' +
          '</style>'
        ).appendTo('body');

        $('html, body').addClass('is-sticky-footer-enabled');
        $(this).attr('data-sticky-footer', '');
      }
    });
  };
}(jQuery));

// jQuery Sticky Footer test suite
describe("jQuery Sticky Footer test suite", function() {

    /**
     * Used to fill content and footer elements with some data
     *
     * @type {string}
     * @private
     */
    var _paragraph = "In website design, a page footer is called a webpage footer which is a the bottom section " +
        "of a website. They can be designed using HTML and CSS. Website footers have text that can show little " +
        "details about the website.";

    /**
     * Some commonly used tag names used to build HTML tags
     *
     * @type {string[]}
     * @private
     */
    var _tagNames = ["div", "ul", "ol", "h1", "h3"];

    /**
     * Some dummy CSS classes used to build HTML tags
     *
     * @type {string[]}
     * @private
     */
    var _cssClasses = ["class1", "class2", "class3", "class4", "class5"];

    /**
     * Builds an HTML tag using the tag name, class attribute and data
     *
     * @param {string} tag
     * @param {string} cssClass (Optional)
     * @param {string} data (Optional)
     * @returns {string}
     * @private
     */
    var _buildHTMLELement = function(tag, cssClass, data) {
        if (typeof data !== "string") {
            data = "";
        }

        var classAttribute = (typeof cssClass === "string") ? "class='" + cssClass + "'" : "";

        return "<" + tag.toString() + " " + classAttribute + ">" + data + "</" + tag.toString() + ">";
    };

    /**
     * Generates the specified number of paragraphs by repeating the snippet from Wikipedia
     *
     * @param {number} count
     * @returns {string}
     * @see _paragraph
     * @private
     */
    var _generateParagraphs = function(count) {
        var string = "";

        for (var i = 0; i < count; i++) {
            string += "<p>" + _paragraph + "</p>";
        }

        return string;
    };

    /**
     * Checks if the footer sticks to the bottom of the page as it should
     *
     * @returns {boolean}
     * @private
     */
    var _checkIfFooterSticksToBottom = function() {
        var footer = $("body > *").eq(1);
        var footerHeight = footer.outerHeight(true);
        var footerTopOffset = footer.offset().top;
        var documentHeight = $(document).outerHeight();

        return (footerHeight + footerTopOffset) === documentHeight;
    };

    // Sets null margin on used HTML tags to make height calculation simpler
    beforeAll(function() {
        // Makes the CSS selector like tag1,tag2,tag3...
        var noMarginTags = (["html", "body", "p"].concat(_tagNames)).join();

        $("head").append(
            "<style type='text/css'>" +
                noMarginTags + " { margin: 0 }" +
                "html.is-sticky-footer-enabled, html.is-sticky-footer-enabled > body {" +
                    "height: 100%;" +
                "}" +
                "html.is-sticky-footer-enabled > body > :not([data-sticky-footer]) {" +
                    "min-height: 100%;" +
                "}" +
                "html.is-sticky-footer-enabled > body > :not([data-sticky-footer])::after {" +
                    "content: \"\";" +
                    "display: block;" +
                "}" +
            "</style>"
        );
    });

    // Clears the environment for the next test
    beforeEach(function () {
        $("body").empty();
    });

    /**
     * Runs the specs for all the tags and CSS classes specified in the sets
     *
     * @see _tagNames
     * @see _cssClasses
     */
    _tagNames.forEach(function(tagName, index) {
        xit("Must stick if content and footer elements are empty", function() {
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index]));
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index]));

            $("body > *").eq(1).stickyFooter();

            expect(_checkIfFooterSticksToBottom()).toBe(true);
        });

        xit("Must stick if the content and footer have some data", function() {
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index], _generateParagraphs(2)));
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index], _generateParagraphs(1)));
            $("body > *").eq(1).stickyFooter();

            expect(_checkIfFooterSticksToBottom()).toBe(true);
        });

        xit("Must not overlap if the content and footer have a lots of data", function() {
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index], _generateParagraphs(80)));
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index], _generateParagraphs(20)));
            $("body > *").eq(1).stickyFooter();

            expect(_checkIfFooterSticksToBottom()).toBe(true);
        });

        it("Sticks to the content when destroyed", function() {
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index], _generateParagraphs(5)));
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index], _generateParagraphs(1)));
            $("body > *").eq(1).stickyFooter();

            expect(
                $("body > *").first().offset().top + $("body > *").first().outerHeight(true)
            ).toBe($("body > *").eq(1).offset().top);
        });

        it("Sticks to the bottom when recreated after the destruction", function() {
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index], _generateParagraphs(5)));
            $("body").append(_buildHTMLELement(tagName, _cssClasses[index], _generateParagraphs(1)));
            $("body > *").eq(1).stickyFooter();
            $("body > *").eq(1).stickyFooter('destroy');
            $("body > *").eq(1).stickyFooter();

            expect(_checkIfFooterSticksToBottom()).toBe(true);
        });
    });
});

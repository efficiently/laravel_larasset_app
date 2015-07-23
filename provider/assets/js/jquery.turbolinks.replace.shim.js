// Experimental IE 8 and 9 compatibility for the `replace()` method of Turbolinks 3
// TODO: Port executeScriptTags(), onNodeRemoved() ?
// WIP: CSRF protection
// See: https://github.com/rails/turbolinks/issues/526

(function($) {
  if (typeof Turbolinks !== 'undefined' && Turbolinks) {
    if (!Turbolinks.supported) {
      var CSRFToken = {
        get: function(doc) {
          if (doc == null) {
            doc = document;
          }
          var tag = $(doc).find('meta[name="csrf-token"]');
          if (!tag || tag.length === 0) {
            tag = $(doc).filter('meta[name="csrf-token"]');
          }

          var param = $(doc).find('meta[name="csrf-param"]');
          if (!param || param.length === 0) {
            param = $(doc).filter('meta[name="csrf-param"]');
          }

          return {
            node: tag,
            token: tag.attr('content'),
            param: param.attr('content')
          };
        },
        update: function(latest) {
          var current = this.get();
          // console.log('Update CSRF Token!');//debug
          if ((current.token != null) && (latest != null) && current.token !== latest) {
            return current.node.attr('content', latest);
          }
        },
        // making sure that all forms have actual up-to-date token(cached forms contain old one)
        refresh: function() {
          // console.log('Refresh Tokens!');//debug
          var current = this.get();
          $('form input[name="' + current.param + '"]').val(current.token);
        }
      };
      Turbolinks.replaceContent = function(content, options) {
        if (typeof content === 'object' && typeof options === 'object') {
          // We can't add a `body` tag, it seems buggy with IE 8 and 9
          var body = $('<div>' + content.body + '</div>');

          var currentBody = $('body');
          if (content.title) {
            document.title = content.title;
          }

          if (options.change) {
            var nodesToChange = $('[data-turbolinks-temporary]', 'body').toArray();
            var matchingNodes = [];
            var keys = $.makeArray(options.change);
            $.each(keys, function(i, key) {
              $.merge(matchingNodes, $('[id^="' + key + ':"], #' + key, 'body').toArray());
            });
            $.merge(nodesToChange, matchingNodes);

            var changedNodes = [];
            $.each(nodesToChange, function(i, existingNode) {
              var nodeId = existingNode.getAttribute('id');
              if (!nodeId) {
                throw new Error('Turbolinks partial replace: turbolinks elements must have an id.');
              }
              var targetNode = $('#' + nodeId, body);
              if (targetNode.length) {
                targetNode = targetNode.clone(true);
                $(existingNode).replaceWith(targetNode);
                changedNodes.push(targetNode);
              }
            });

            $(changedNodes).trigger('page:load');
          } else if (options.flush) {
            var targetNode = body.html();
            currentBody.empty().append(targetNode);
            currentBody = $('body');
            if (content.csrfToken) {
              CSRFToken.update(content.csrfToken);
            }
            currentBody.trigger('page:load');
          } else {
            var nodesToKeep = $('[data-turbolinks-permanent]', 'body').toArray();
            if (options.keep) {
              var matchingNodes = [];
              var keys = $.makeArray(options.keep);
              $.each(keys, function(i, key) {
                $.merge(matchingNodes, $('[id^="' + key + ':"], #' + key, 'body').toArray());
              });
              $.merge(nodesToKeep, matchingNodes);
            }

            $.each(nodesToKeep, function(i, existingNode) {
              var nodeId = existingNode.getAttribute('id');
              if (!nodeId) {
                throw new Error('Turbolinks partial replace: turbolinks elements must have an id.');
              }
              var targetNode = $('#' + nodeId, body);
              if (targetNode.length) {
                $(targetNode).replaceWith($(existingNode).clone(true));
              }
            });

            currentBody.empty().append(body.html());
            currentBody = $('body');
            if (content.csrfToken) {
              CSRFToken.update(content.csrfToken);
            }
            currentBody.trigger('page:load');
          }

          //test
          $.ajaxPrefilter(function(options, originalOptions, xhr) {
            if (!options.crossDomain && $.rails) {
              // console.log('Refresh X-CSRF-Token');//debug
              $.rails.CSRFProtection(xhr);// TODO: port this Rails UJS method
            }
          });

          CSRFToken.refresh();

          return true;// TODO: Reflect the Turbolinks.defaultReplace() return behaviour
        } else {
          throw new Error('Invalid arguments');
          // Fallback to default Turbolinks.replace() method?
          // return Turbolinks.defaultReplace(html, options);
        }
      };

      Turbolinks.defaultReplace = Turbolinks.replace;
      Turbolinks.replace = function(html, options) {
        if (typeof options === 'undefined' || options === null) {
          options = {};
        }
        var $html = $(html);
        var csrfTokenContent = CSRFToken.get(html).token;
        var $title = $html.filter('title');
        var titleContent = null;
        if ($title.length) {
          titleContent = $title.html();
        } else {
          // For IE 8
          var result = html.match(/<title>([^<]+)<\/title>/);
          if (result) {
            titleContent = result[1];
          }
        }
        var bodyContent = html.replace(/^(.|[\n\r])*<body[^>]*>((.|[\n\r])*)<\/body>(.|[\n\r])*$/im, '$2');
        var content = {title: titleContent, body: bodyContent, csrfToken: csrfTokenContent};
        return Turbolinks.replaceContent(content, options);
      };
    }
  }
})(jQuery);

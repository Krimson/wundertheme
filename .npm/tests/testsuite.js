var pages = [
  {
    'label': 'homepage',
    'selector': 'homepage',
    'url': '/',
    'delay': 500,
  }
];

casper.start()
  .then(function() {
    pages.forEach(function(page) {
      casper
        .thenOpen('http://localhost:3000' + page.url)
        .then(function() {
          var ignore = page.ignore,
              delay = page.delay || 500,
              name = page.label,
              selector = page.cssSelector || 'html';
          phantomcss.screenshot(selector, delay, ignore, name);
        });
    });
  });

casper.run();

const buildify = require('buildify'),
  filesJS = [
    './src/js/jquery.min.js',
    './src/js/bootstrap.min.js',
    './src/js/script.js'
  ],
  filesCSS = [
    './dist/css/local_style.css',
    './dist/css/style.css'
  ];

  buildify()
    .concat( filesCSS )
    .cssmin()
    .save( './dist/css/style.min.css' );

  buildify()
    .concat( filesJS )
    .uglify()
    .save( './dist/js/script.js' );

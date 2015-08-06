module.exports = function (grunt) {
// code goes here!
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    clean: {
      js: [
        "public/assets/css/source.min.css",
        "public/assets/js/source.min.js"
      ]
    },
//    watch: {
//      scripts: {
//        files: [
//          "public/assets/css/style.css",
//          "public/assets/js/source.min.js"
//        ],
//        tasks: ['generateFileManifest'],
//        options: {
//          event: ['deleted'],
//        },
//      },
//    },
    less: {
      development: {
        options: {
          paths: ["public/assets/css"]
        },
        files: {
          "public/assets/css/style.css": "public/assets/css/style.less"
        }
      }
//      ,
//      production: {
//        options: {
//          paths: ["assets/css"],
//          plugins: [
//            new require('less-plugin-autoprefix')({browsers: ["last 2 versions"]}),
//            new require('less-plugin-clean-css')(cleanCssOptions)
//          ],
//          modifyVars: {
//            imgPath: '"http://mycdn.com/path/to/images"',
//            bgColor: 'red'
//          }
//        },
//        files: {
//          "path/to/result.css": "path/to/source.less"
//        }
//      }
    },
//    cssmin: {
//      target: {
//        files: [{
//            expand: true,
//            cwd: 'public/assets/css',
//            src: ['*.css', '!*.min.css'],
//            dest: 'public/assets/css',
//            ext: '.min.css'
//          }]
//      }
//    }
    cssmin: {
      options: {
        shorthandCompacting: false,
        roundingPrecision: -1
      },
      target: {
        files: {
          'public/assets/css/source.min.css': [
            'public/assets/plugins/bootstrap/css/bootstrap.min.css',
            'public/assets/plugins/bootstrap-dialog/css/bootstrap-dialog.min.css',
            'public/assets/plugins/owl-carousel/owl.carousel.css',
            'public/assets/plugins/owl-carousel/owl.theme.css',
            'public/assets/plugins/owl-carousel/owl.transitions.css',
            'public/assets/css/icon/icon.css',
            'public/assets/css/*.css'
          ]
        }
      }
    },
    uglify: {
      options: {
        mangle: false
      },
      my_target: {
        files: {
          'public/assets/js/source.min.js': [
            'public/assets/js/jquery.js',
            'public/assets/angular/angular.min.js',
            'public/assets/angular/angular-route/angular-route.min.js',
            'public/assets/plugins/wow.min.js',
            'public/assets/plugins/bootstrap/js/bootstrap.min.js',
            'public/assets/plugins/bootstrap-dialog/js/bootstrap-dialog.min.js',
            'public/assets/plugins/owl-carousel/owl.carousel.js'
//            'public/assets/app/*.js'
          ]
        }
      }
    },
//    concat: {
//      options: {
//        separator: ';',
//      },
//      dist: {
//        src: [
//            'public/assets/js/jquery.js',
//            'public/assets/angular/angular.min.js',
//            'public/assets/angular/angular-route/angular-route.min.js',
//            'public/assets/app/*.js',
//            'public/assets/plugins/wow.min.js',
//            'public/assets/plugins/bootstrap/js/bootstrap.min.js',
//            'public/assets/plugins/bootstrap-dialog/js/bootstrap-dialog.min.js',
//            'public/assets/plugins/owl-carousel/owl.carousel.js',
//          
//        ],
//        dest: 'public/assets/js/source.min.js',
//      },
//    }
  });
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.registerTask('default', [/*'watch'*/'clean', 'less', 'cssmin', 'uglify'/*, 'concat'*/]); // สร้างคำสั่งที่เราจะใช้สำหรับ run task
}
module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            css: {
                src: [
                    'public/css/*'
                ],
                dest: 'public/production.css'
            },
            js: {
                src: [
                    'public/js/*'
                ],
                dest: 'public/production.js'
            }
        },
        cssmin : {
            css:{
                src: 'public/production.css',
                dest: 'public/production.min.css'
            }
        },
        uglify: {
            js: {
                files: {
                    'public/production.min.js': ['public/production.js']
                }
            },
            options: {
                    report: 'min',
                    mangle: false
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', ['concat:css', 'cssmin:css', 'concat:js', 'uglify:js']);
};
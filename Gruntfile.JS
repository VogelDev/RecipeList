module.exports = function (grunt) {

    const webpackConfig = require('./webpack.config');

    grunt.initConfig({
        watch: {
            scripts: {
                files: [
                    'src/**/*.js',
                    'src/**/*.vue'
                ],
                tasks: ['webpack:prod'],
                options: {
                    interrupt: true,
                },
            },
        },
        clean: {
            js: ['site/**/*.js'],
            //folder_v2: ['path/to/dir/**']
        },
        browserSync: {
            bsFiles: {
                src: [
                    'site/**/*.css',
                    'site/**/*.html',
                    'site/**/*.js'
                ]
            },
            options: {
                watchTask: true,
                server: {
                    baseDir: "./site"
                }
            }
        },
        webpack: {
            options: {
                //stats: !process.env.NODE_ENV || process.env.NODE_ENV === 'development'
            },
            prod: webpackConfig,
            // dev: Object.assign({ watch: true }, webpackConfig)
        }
    });
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-webpack');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-browser-sync');

    // A very basic default task.
    // grunt.registerTask('customTask', 'Log some stuff.', function () {
    //     grunt.log.write('Change Detected').ok();
    //     grunt.task.run(['webpack:prod'])
    // });

    // Default task(s).
    grunt.registerTask('default', ['clean', 'webpack:prod', 'browserSync', 'watch']);
};
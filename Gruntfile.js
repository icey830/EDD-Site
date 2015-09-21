module.exports = function(grunt) {
	grunt.initConfig({

		// less
		less: {
			development: {
				options: {
					compress: true,
					yuicompress: true,
					optimization: 2
				},
				files: {
					"style.css": "css/less/style.less"
				}
			}
		},

		// concat
		concat: {
			js: {
				options: {
					separator: ';'
				},
				src: ['js/dev/theme.js'],
				dest: 'js/theme.min.js'
			},
		},

		// uglify
		uglify: {
			options: {
				mangle: false
			},
			js: {
				files: {
					'js/theme.min.js': ['js/theme.min.js']
				}
			}
		},

		// svg store
		svgstore: {
			options: {
				prefix : 'icon-', // This will prefix each <g> ID
				svg : {
					'xmlns:sketch' : 'http://www.bohemiancoding.com/sketch/ns',
					'xmlns:dc': "http://purl.org/dc/elements/1.1/",
					'xmlns:cc': "http://creativecommons.org/ns#",
					'xmlns:rdf': "http://www.w3.org/1999/02/22-rdf-syntax-ns#",
					'xmlns:svg': "http://www.w3.org/2000/svg",
					'xmlns': "http://www.w3.org/2000/svg",
					'xmlns:sodipodi': "http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd",
					'xmlns:inkscape': "http://www.inkscape.org/namespaces/inkscape"
				}
			},
			default : {
				files: {
					'images/svg-defs.svg': ['svgs/*.svg'],
				}
			}
		},

		watch: {
			styles: {
				files: ['css/less/*.less'],
				tasks: ['less'],
				options: {
					nospawn: true
				}
			},
			js: {
				files: ['js/src/**/*.js'],
				tasks: ['concat:js', 'uglify:js'],
			},
			svgstore: {
				files: ['svgs/*.svg'],
				tasks: ['svgstore:default']
			}
		},

	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-svgstore');

	grunt.registerTask('default', ['concat', 'uglify', 'watch', 'svgstore']);

};
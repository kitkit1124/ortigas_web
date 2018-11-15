module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		copy: {
			main: {
				files: [
					{expand: true, cwd: 'node_modules/bootstrap/dist/', src: ['**'], dest: 'pub/npm/bootstrap/'},
					{expand: true, cwd: 'node_modules/popper.js/dist/', src: ['**'], dest: 'pub/npm/popper.js/'},
					{expand: true, cwd: 'node_modules/jquery/dist/', src: ['**'], dest: 'pub/npm/jquery/'}
				],
			},
		},
		concat: {
			css: {
				src: [
					'node_modules/bootstrap/dist/css/bootstrap.css',
					'pub/themes/default/css/src/custom.css'
				],
				dest: 'pub/themes/default/css/build/styles.css'
			},
			js: {
				src: [
					'node_modules/jquery/dist/jquery.js',
					'node_modules/popper.js/dist/umd/popper.js',
					'node_modules/bootstrap/dist/js/bootstrap.js',
					'pub/themes/default/js/src/custom.js'
				],
				dest: 'pub/themes/default/js/build/scripts.js'
			}
		},
		cssmin: {
			css: {
				src: 'pub/themes/default/css/build/styles.css',
				dest: 'pub/themes/default/css/styles.min.css'
			}
		},
		uglify: {
			js: {
				src: 'pub/themes/default/js/build/scripts.js',
				dest: 'pub/themes/default/js/scripts.min.js'
			}
		},
		watch: {
		    css: {
		        files: ['pub/themes/default/css/src/custom.css'],
		        tasks: ['concat:css', 'cssmin:css']
		    },
		    js: {
		        files: ['pub/themes/default/js/src/custom.js'], 
		        tasks: ['concat:js', 'uglify:js']
		    },
		}
		
	});

	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('default', ['copy', 'concat', 'cssmin', 'uglify']);
};
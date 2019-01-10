module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		copy: {
			main: {
				files: [
					{expand: true, cwd: 'node_modules/bootstrap/dist/', src: ['**'], dest: 'pub/npm/bootstrap/'},
					{expand: true, cwd: 'node_modules/popper.js/dist/', src: ['**'], dest: 'pub/npm/popper.js/'},
					{expand: true, cwd: 'node_modules/jquery/dist/', src: ['**'], dest: 'pub/npm/jquery/'},
					{expand: true, cwd: 'node_modules/jquery-ui/', src: ['**'], dest: 'pub/npm/jquery-ui/'},
					{expand: true, cwd: 'node_modules/datatables.net/', src: ['**'], dest: 'pub/npm/datatables.net/'},
					{expand: true, cwd: 'node_modules/datatables.net-bs4/', src: ['**'], dest: 'pub/npm/datatables.net-bs4/'},
					{expand: true, cwd: 'node_modules/datatables.net-responsive/', src: ['**'], dest: 'pub/npm/datatables.net-responsive/'},
					{expand: true, cwd: 'node_modules/datatables.net-responsive-bs4/', src: ['**'], dest: 'pub/npm/datatables.net-responsive-bs4/'},
					{expand: true, cwd: 'node_modules/dropzone/dist/min/', src: ['**'], dest: 'pub/npm/dropzone/'},
					{expand: true, cwd: 'node_modules/font-awesome/', src: ['**'], dest: 'pub/npm/font-awesome/'},
					{expand: true, cwd: 'node_modules/jquery.cookie/', src: ['**'], dest: 'pub/npm/jquery.cookie/'},
					{expand: true, cwd: 'node_modules/select2/dist/', src: ['**'], dest: 'pub/npm/select2/'},
					{expand: true, cwd: 'node_modules/alertify/', src: ['**'], dest: 'pub/npm/alertify/'},
					{expand: true, cwd: 'node_modules/tiny-lr/', src: ['**'], dest: 'pub/npm/tinymce/'},
					{expand: true, cwd: 'node_modules/jquery.inputmask/dist/inputmask', src: ['**'], dest: 'pub/npm/jquery.inputmask/'},
					{expand: true, cwd: 'node_modules/blockui-npm/', src: ['**'], dest: 'pub/npm/blockui-npm/'},
					{expand: true, cwd: 'node_modules/@frontwise/grid-editor/dist/', src: ['**'], dest: 'pub/npm/grid-editor/'},
					{expand: true, cwd: 'node_modules/datetimepicker/dist/', src: ['**'], dest: 'pub/npm/datetimepicker/'},
					{expand: true, cwd: 'node_modules/tinymce/', src: ['**'], dest: 'pub/npm/tinymce/'},
					{expand: true, cwd: 'node_modules/jquery-number/', src: ['**'], dest: 'pub/npm/jquery-number/'},
					{expand: true, cwd: 'node_modules/fontawesome-iconpicker/dist/', src: ['**'], dest: 'pub/npm/fontawesome-iconpicker/'},
					{expand: true, cwd: 'node_modules/nestable2/dist/', src: ['**'], dest: 'pub/npm/nestable2/'},
					{expand: true, cwd: 'node_modules/slick-carousel/', src: ['**'], dest: 'pub/npm/slick-carousel/'}
				],
			},
		},
		concat: {
			css: {
				src: [
					'node_modules/bootstrap/dist/css/bootstrap.css',
					'pub/themes/default/css/src/custom.css',
					'pub/npm/slick-carousel/slick/slick.css',
					'pub/npm/slick-carousel/slick/slick-theme.css'
				],
				dest: 'pub/themes/default/css/build/styles.css'
			},
			js: {
				src: [
					'node_modules/jquery/dist/jquery.js',
					'node_modules/popper.js/dist/umd/popper.js',
					'node_modules/bootstrap/dist/js/bootstrap.js',
					'pub/themes/default/js/src/custom.js',
					'pub/npm/slick-carousel/slick/slick.min.js'
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
module.exports = function(grunt) {
  grunt.initConfig({
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
    watch: {
      styles: {
        files: ['css/less/*.less'],
        tasks: ['less'],
        options: {
          nospawn: true
        }
      }
    },
    'sftp-deploy': {
      build: {
        auth: {
          host: 'edd.staging.wpengine.com',
          port: 22,
          authKey: 'staging'
        },
        src: '.',
        dest: '/wp-content/themes/edd-v2/',
        exclusions: ['.DS_Store', './git']
      },
      css: {
        auth: {
          host: 'edd.staging.wpengine.com',
          port: 22,
          authKey: 'staging'
        },
        src: '.',
        dest: '/wp-content/themes/edd-v2/',
        exclusions: ['.DS_Store', './git']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-sftp-deploy');

  grunt.registerTask('default', ['watch', 'sftp-deploy']);
};
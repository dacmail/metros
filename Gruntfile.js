/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    meta: {
      version: '0.1.0'
    },
    banner: '/*! PROJECT_NAME - v<%= meta.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '* http://PROJECT_WEBSITE/\n' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> ' +
      'YOUR_NAME; Licensed MIT */\n',
    // Task configuration.
    concat: {
      bootstrapjs: {
        src: ['bower_components/bootstrap/dist/js/bootstrap.min.js'],
        dest: 'js/bootstrap.min.js'
      },
      bootstrapcss: {
        src: ['bower_components/bootstrap/dist/css/bootstrap.min.css'],
        dest: 'css/bootstrap.min.css'
      }
    },
    copy: {
      fonts: {
          expand: true,
          cwd: 'bower_components/bootstrap/dist/fonts/',
          src: '*',
          dest: 'fonts/',
          flatten: true,
          filter: 'isFile',
      },
    },
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');



  // Default task.
  grunt.registerTask('assets', ['concat:bootstrapjs', 'concat:bootstrapcss', 'copy:fonts']);

};

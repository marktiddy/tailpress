const gulp = require("gulp");
const zip = require("gulp-zip");

exports.default = async () => {
  await gulp
    .src(["*", "*/**", "!node_modules/**", "vendor/*/**"], { base: "./" })
    .pipe(zip("tailpress.zip"))
    .pipe(gulp.dest("../"));
};

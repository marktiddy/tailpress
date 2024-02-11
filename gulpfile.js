import gulp from "gulp";
const { src, dest } = gulp;
import zip from "gulp-zip";

export default async () => {
  await src(["*", "*/**", "!node_modules/**", "vendor/*/**"], { base: "./" })
    .pipe(zip("tailpress.zip"))
    .pipe(dest("../"));
};

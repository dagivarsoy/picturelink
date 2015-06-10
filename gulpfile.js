var gulp = require('gulp');
var responsive = require('gulp-responsive');

gulp.task('img', function(){
    return gulp.src('/img/**/*')
        .pipe(
        responsive(
            {
                '**/*' : [
                    {
                        width: 320,
                        withoutEnlargement: false,
                        rename: {
                            //prefix: "50-x-",
                            suffix: "320"
                            //path.extname = ".md"
                        }
                    },
                    {
                        width: 320 * 2,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "320@2x"
                        }
                    },
                    {
                        width: 320 * 3,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "320@3x"
                        }
                    },
                    {
                        width: 480,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "480"
                        }
                    },
                    {
                        width: 480 * 2,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "480@2x"
                        }
                    },
                    {
                        width: 480 * 3,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "480@3x"
                        }
                    },
                    {
                        width: 768,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "768"
                        }
                    },
                    {
                        width: 768 * 2,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "768@2x"
                        }
                    },
                    {
                        width: 768 * 3,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "768@3x"
                        }
                    },
                    {
                        width: 1024,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "1024"
                        }
                    },
                    {
                        width: 1024 * 2,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "1024@2x"
                        }
                    },
                    {
                        width: 1024 * 3,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "1024@3x"
                        }
                    },
                    {
                        width: 1224,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "1224"
                        }
                    },
                    {
                        width: 1224 * 2,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "1224@2"
                        }
                    },
                    {
                        width: 1224 * 3,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "1224@3"
                        }
                    },
                    {
                        width: 1824,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "1824"
                        }
                    },
                    {
                        width: 1824 * 2,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "1824@2x"
                        }
                    },
                    {
                        width: 1824 * 3,
                        withoutEnlargement: false,
                        rename: {
                            suffix: "1824@3x"
                        }
                    },
                ]
            })
    )
        .pipe(gulp.dest('/img'));
});

gulp.task('watch:img', function(){
    gulp.watch('/src/img/*',['img']);
});


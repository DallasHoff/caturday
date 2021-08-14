// Swup for page transitions
var swup = new Swup({
    containers: ['#app'],
    cache: false,
    plugins: [
        new SwupHeadPlugin({
            persistTags: 'style'
        }),
        new SwupScriptsPlugin({
            head: true,
            body: true
        })
    ]
});

// Scroll to top on page change
swup.on('animationInStart', () => {
    document.body.scrollIntoView();
});
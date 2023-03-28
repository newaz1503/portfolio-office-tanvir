const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/frontend_app.js", "public/js")
    .js("resources/js/login_app.js", "public/js")
    .vue();
// COPY FILES / DIRECTORY
mix.copyDirectory("resources/js/assets/public", "public")
    .copyDirectory("resources/js/assets/admin", "public/admin")
    .copyDirectory("resources/js/assets/website", "public/website");
// FOR CHANK
let config = {
    output: {
        publicPath: process.env.MIX_VUE_ROUTER_BASE
            ? "/" + process.env.MIX_VUE_ROUTER_BASE + "/public/"
            : "/",
        chunkFilename: "js/chunks/[name].js"
    }
};
mix.webpackConfig(config);

var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('layout-front', [
        './public/css/bootstrap.min.css',
        './public/css/slick.css',
        './public/css/slick-theme.css',
        './public/css/components/variables.css',
        './public/css/components/animations.css',
        './public/css/components/layout.css',
        './public/css/components/header.css',
        './public/css/components/footer.css',
        './public/css/components/list.css',
        './public/css/components/animated-card.css',
        './public/css/components/fonts.css',
        './public/css/components/buttons.css',
        './public/css/components/pagination.css',
        './public/js/jquery-3.5.1.slim.min.js',
        './public/js/popper.min.js',
        './public/js/bootstrap.min.js',
        './public/js/fontawesome.js',
        './public/js/slick.min.js',
        './public/js/layout.js',
    ])
    .addEntry('animated-card', [
        './public/js/animated-card.js',
    ])
    .addEntry('view-entity', [
        './public/css/view-entity.css',
    ])
    .addEntry('front-list', [
        './public/css/bootstrap-datepicker3.min.css',
        './public/js/animated-card.js',
        './public/js/bootstrap-datepicker.min.js',
        './public/js/bootstrap-datepicker.fr.min.js',
        './public/js/list.js',
    ])
    .addEntry('signup', [
        './public/css/signup.css',
    ])
    .addEntry('licenses', [
        './public/css/license.css',
        './public/css/licenses/the-legend-of-zelda.css',
        './public/css/licenses/super-mario.css',
        './public/css/licenses/super-smash-bros.css',
        './public/css/licenses/pokemon.css',
        './public/css/licenses/donkey-kong.css',
        './public/js/animated-card.js',
        './public/js/license.js',
    ])
    .addEntry('homepage', [
        './public/css/homepage.css',
        './public/js/animated-card.js',
    ])
    .addEntry('game', [
        './public/css/games.css',
        './public/css/license.css',
        './public/css/licenses/the-legend-of-zelda.css',
        './public/css/licenses/super-mario.css',
        './public/css/licenses/super-smash-bros.css',
        './public/css/licenses/pokemon.css',
        './public/css/licenses/donkey-kong.css',
        './public/js/animated-card.js',
        './public/js/license.js',
    ])
    .addEntry('form-backoffice', [
        './public/css/components/form-backoffice.css',
        './public/js/admin/form.js',
    ])
    .addEntry('layout-backoffice', [
        './public/css/bootstrap.min.css',
        './public/css/bootstrap-datepicker3.min.css',
        './public/css/components/animations.css',
        './public/css/components/layout-admin.css',
        './public/css/components/header-backoffice.css',
        './public/css/components/fonts.css',
        './public/js/jquery-3.5.1.slim.min.js',
        './public/js/popper.min.js',
        './public/js/bootstrap.min.js',
        './public/js/bootstrap-datepicker.min.js',
        './public/js/bootstrap-datepicker.fr.min.js',
        './public/js/fontawesome.js',
        './public/js/admin/header.js',
    ])
    .addEntry('list-backoffice', [
        './public/css/components/lists-backoffice.css',
        './public/js/admin/lists.js',
    ])
    .addEntry('manage-entity-backoffice', [
        './public/css/components/lists-backoffice.css',
        './public/css/components/form-backoffice.css',
        './public/js/admin/lists.js',
        './public/js/admin/form.js',
    ])
    .addEntry('dashboard-backoffice', [
        './public/css/dashboard.css',
    ])

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    //.enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
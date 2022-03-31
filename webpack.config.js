const path = require("path");
const webpack = require("webpack");
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const UglifyJSPlugin = require("uglifyjs-webpack-plugin");
const OptimizeCssAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

const config = {
  entry: {
    app: "./wp-content/themes/kmoskala_theme/assets/js/index.js"
  },
  output: {
    filename: "./js/bundle.js", // /public/.js/*
    path: path.resolve(__dirname, "./wp-content/themes/kmoskala_theme/public/")
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
          fallback: "style-loader",
          use: [
            {
              loader: "css-loader",
              options: {
                sourceMap: true
              }
            },
            {
              loader: "postcss-loader",
              options: {
                sourceMap: "inline",
                plugins: () => [
                  require("autoprefixer")({
                    browsers: ["last 3 versions", ">0%"]
                  })
                ]
              }
            },
            {
              loader: "sass-loader",
              options: {
                sourceMap: true
              }
            }
          ]
        })
      },
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        loader: "babel-loader",
        query: {
          presets: ["es2015"]
        }
      },
      {
        test: /\.(jpe?g|png|woff|woff2|eot|ttf|svg)(\?[a-z0-9=.]+)?$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: "[name].[ext]",
              publicPath: "./public/images/",
              outputPath: "./images/",
            }
          }
        ]
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin("../style.css"),
    new BrowserSyncPlugin({
      proxy: "http://localhost:8888/cakegallery/", // CHANGE THIS TO LOCALHOST REL PATH
      port: 8888,
      files: ["**/*.php", "**/*.twig"],
      ghostMode: {
        clicks: true,
        location: true,
        forms: true,
        scroll: true
      },
      injectChanges: true,
      logFileChanges: true,
      logLevel: "debug",
      logPrefix: "wepback",
      notify: true,
      reloadDelay: 0
    }),
  ]
};

//If true, JS and CSS files will be minified
if (process.env.NODE_ENV === "production") {
  config.plugins.push(new UglifyJSPlugin(), new OptimizeCssAssetsPlugin());
}

module.exports = config;

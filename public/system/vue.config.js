module.exports = {
    publicPath: process.env.NODE_ENV === 'production' ? '/system/dist/' : '/',
    assetsDir: '',
    productionSourceMap: true,
    devServer: {
        proxy: {
            '/api': {
                target: 'http://yang.fifa.test/api/',
                changeOrigin: true,
                pathRewrite: {
                    '/api': 'http://yang.fifa.test/api/'
                }
            }
        }
    }
}
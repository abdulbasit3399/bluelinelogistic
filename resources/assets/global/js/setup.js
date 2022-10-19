var echo = console.log.bind(console, '>')
window.echo = echo;


function isJSON(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
window.isJSON = isJSON;


// slug plugin
var slug = require('slug')
window.slug = slug



// slug plugin
var Quill = require('quill')
window.Quill = Quill
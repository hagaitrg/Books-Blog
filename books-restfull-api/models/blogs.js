const mongoose = require('mongoose');

const blogSchema = mongoose.Schema({
    title: String,
    category: String,
    desc: String,
    image: String,
    created: {
        type: Date,
        default: Date.now()
    }
});

module.exports = mongoose.model("Blog", blogSchema);
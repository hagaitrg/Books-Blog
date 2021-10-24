const Blog = require('../models/blogs')

module.exports = class API {

    // get all blogs
    static async showAllBlogs(req, res) {
        try {
            const blogs = await Blog.find();
            res.status(200).json(blogs);
        } catch (err) {
            res.status(404).json({ message: err.message })
        }
    }

    // get blogs by id
    static async showBlogsByID(req, res) {
        res.send('Show Blogs by Id')
    }

    // create a blog
    static async createBlog(req, res) {
        res.send('create Blog')
    }

    // Update a blog
    static async updateBlog(req, res) {
        res.send('update blog')
    }

    // delete a blog
    static async deleteBlog(req, res) {
        res.send('delete blog')
    }
}
const express = require('express');
const router = express.Router();
const API = require('../controllers/api');

router.get('/v1/showAll', API.showAllBlogs)
router.get('/v1/:id', API.showBlogsByID)
router.post('/v1', API.createBlog)
router.put('/v1/:id', API.updateBlog)
router.delete('/v1/:id', API.deleteBlog)


module.exports = router;
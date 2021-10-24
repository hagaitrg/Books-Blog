require('dotenv').config()
const express = require('express')
const mongoose = require('mongoose')
const cors = require('cors')

const app = express()
const port = process.env.PORT || 5000

// middlewares
app.use(cors())
app.use(express.json())
app.use(express.urlencoded({ extended: true }))
app.use(express.static('uploads'))

// database connection
mongoose.connect(process.env.DB_URI, {
    useNewUrlParser: true,
    useUndifiendTopology: true,
    useFindAndModify: true,
    useCreateIndex: true,
}).then(() => console.log('Connected to the DB')).catch(err => console.error(err))

// routes prefix
app.use("/api/blogs", require("./routes/routes"))

// start server
app.listen(port, () => console.log(`server running on at http://localhost:${port}`))


import axios from 'axios'

const axiosInstance = axios.create({
  baseURL: process.env.VUE_APP_API_URL || 'http://127.0.0.1:8000',  // Laravel backend URL
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})

export default axiosInstance

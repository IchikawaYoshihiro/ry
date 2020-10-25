import axios from "axios";

// axios.defaults.baseURL = 'http://localhost:8000';

export const Api = {
  create(url: string) {
    return axios.get('/api/redirects/create', { params: { url } });
  },
  createMany(urls: string[]) {
    return axios.get('/api/redirects/create_many', { params: { urls } });
  },
}
let path = '/api/boxes'
import axios from 'axios'

export default {
    async importBoxes(data) {
        return axios.post(`${path}`, {
            data: data
        });
    },
    async exportBoxes(data) {
        return axios.delete(`${path}`, {
            data: {data: data}
        });
    },
    async moveBoxes(data) {
        return axios.put(`${path}`, {
            data: data
        });
    },
}

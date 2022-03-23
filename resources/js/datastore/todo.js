import axios from "axios";
const API = '/api/todo';

export default {
    getAll: async () =>  {
        return await axios
            .get(`${API}`)
            .then(response => response.data)
            .catch(error => {
                throw new Error('API Error Occurred.');
            });

    },

    create: async (toDo) => {
        return await axios
            .post(`${API}`, { 'todo': toDo })
            .catch(error => {
                throw new Error('API Error Occurred.')
            });
    },

    delete: async (toDoId) => {
        return await axios
            .delete(`${API}/${toDoId}`)
            .catch(error => {
                throw new Error('API Error Occurred.');
            })
    }
}
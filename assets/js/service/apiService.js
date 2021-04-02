import axios from "axios";

export const contentNames = {
    CONTACT: 'contact',
    ABOUT: 'about',
    PROJECTS: 'projects',
    MAIN: 'main',
}

class ApiServiceClass
{
    fetchPageContents(pageName) {
        return axios.get('/api/pages.json?name=' + pageName)
            .then(res => {
                if (undefined !== res.data[0]) return res.data[0]
            })
            .catch(error => console.log(error));
    }

    fetchProjects() {
        return axios.get('/api/projects.json')
            .then(res => {
                return res.data
            })
            .catch(error => console.log(error));
    }
}

export const apiService = new ApiServiceClass();
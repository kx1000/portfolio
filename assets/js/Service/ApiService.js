import axios from "axios";

export const contentNames = {
    CONTACT: 'contact',
    SENT: 'sent',
    ABOUT: 'about',
    PROJECTS: 'projects',
    HEADER: 'header',
    FOOTER: 'footer',
}

class ApiServiceClass
{
    fetchContent(contentName) {
        return axios.get('/api/contents.json?name=' + contentName)
            .then(res => {
                if (undefined !== res.data[0]) return res.data[0]
            })
            .catch(error => console.log(error));
    }
}

export const ApiService = new ApiServiceClass();
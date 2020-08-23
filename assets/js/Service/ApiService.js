import axios from "axios";

export const contentNames = {
    CONTACT_CONTENT_NAME: 'contact',
    SENT_CONTENT_NAME: 'sent',
    ABOUT_CONTENT_NAME: 'about',
    PROJECTS_CONTENT_NAME: 'projects',
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
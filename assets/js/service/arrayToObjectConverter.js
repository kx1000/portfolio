export default {
    convert: array => {
        let contents = {};
        array.contents.forEach((content) => {
            contents[content.name] = content.value;
        });
        return contents;
    }
}
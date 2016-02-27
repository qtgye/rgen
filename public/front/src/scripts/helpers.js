/**
 * Tests whether the argument supplied is a function
 * @return {Boolean}
 */
function isFunction( fn ) {
    return fn instanceof Function;
}

/**
 * Checks whether a given item is present in the given array
 * @param  {any} item = the item to be searched
 * @param  {array} arr  = the array to search from
 * @return {Boolean} 
 */
function inArray( item, arr ) {
    if ( !(arr instanceof Array) ) return false;
    return arr.indexOf(item) > -1;
}

/**
 * gets a short string of the file type
 * @param  {object} fileObject File instance
 * @return {string} photo | video | document | other
 */
function getFileType (file) {       
    if ( ! (file instanceof File) ) return '';

    if ( file.name.match(/[.](jpg|jpeg|png|gif|bmp)$/i) ) {
        return 'image';
    }
    else if ( file.name.match(/[.](mp4|mpeg|avi|mov|3gp|wmv|mkv)$/i) ) {
        return 'video';
    }
    else if ( file.name.match(/[.](wav|mp3|wma)$/i) ) {
        return 'audio';
    }
    else if ( file.name.match(/[.](doc|docx|txt)$/i) ) {
        return 'document';
    }
    else if ( file.name.match(/[.](pdf)$/i) ) {
        return 'pdf';
    }
    return 'other';
}
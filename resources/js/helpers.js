export const FORM_ERROR_STATUS_CODE = 422;

/**
 * 
 * @param {*} responseErrors object where key is field name and value is array of error messages (Default laravel validator response)
 * 
 * @returns Object where key is field name and value is first error message
 */
export const mapInputErrors = (responseErrors) => {
    let errors = {};

    if (!responseErrors) { return errors; }

    for (const fields in responseErrors) {
        errors[fields] = responseErrors[fields][0];
    }

    return errors;
}
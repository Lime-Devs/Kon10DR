import React from "react";

function InputError({ message, className = "", ...props }) {
    return message ? (
        <p {...props} className={"text-sm text-red-600 " + className}>
            {message}
        </p>
    ) : null;
}

export default InputError;

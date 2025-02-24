import { forwardRef, useEffect, useImperativeHandle, useRef } from 'react';

export default forwardRef(function TextInput(
    { type = 'text', className = '', isFocused = false, ...props },
    ref,
) {
    const localRef = useRef(null);

    // Aplicando a borda ou outras alterações assim que o componente for montado
    useEffect(() => {
        if (localRef.current) {
            localRef.current.classList.add('border-lime-300');  // Garantir que a borda seja aplicada
        }
    }, []);  // Só executa uma vez após o primeiro render

    useImperativeHandle(ref, () => ({
        focus: () => localRef.current?.focus(),
    }));

    useEffect(() => {
        if (isFocused) {
            localRef.current?.focus();
        }
    }, [isFocused]);

    return (
        <input
            {...props}
            type={type}
            className={
                'rounded-md border border-gray-300 bg-white text-black shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 dark:border-gray-700 dark:bg-white dark:text-black dark:focus:border-blue-600 dark:focus:ring-blue-600 p-2 ' +
                className
            }
            ref={localRef}
        />
    );
});

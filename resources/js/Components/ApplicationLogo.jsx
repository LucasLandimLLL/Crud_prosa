export default function ApplicationLogo(props) {
    return (
        <img
            {...props}
            src="https://s3-sa-east-1.amazonaws.com/projetos-artes/fullsize%2f2017%2f08%2f17%2f20%2fLogo-e-Papelaria-219990_68710_201540113_1824854117.jpg"
            alt="Logo"
            className={`rounded-full object-cover w-32 h-32 ${props.className}`} // Classes para arredondar e tornar responsivo
        />
    );
}
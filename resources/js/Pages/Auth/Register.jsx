import { useState, useEffect } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const [borderColor, setBorderColor] = useState('border-lime-300');

    useEffect(() => {
        // Verificando se os campos têm valor para atualizar a borda
        if (data.name || data.email || data.password || data.password_confirmation) {
            setBorderColor('border-lime-500'); // Atualizando a cor da borda
        } else {
            setBorderColor('border-lime-300'); // Borda padrão
        }
    }, [data]); // Dependendo de qualquer alteração nos campos do formulário

    const submit = (e) => {
        e.preventDefault();

        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Registro" />

            <div>
                <form onSubmit={submit}>
                    <div>
                        <InputLabel htmlFor="name" value="Nome" className="text-black" />
                        <TextInput
                            id="name"
                            name="name"
                            value={data.name}
                            className={`mt-1 block w-full text-black dark:text-gray-300 ${borderColor} rounded-md p-2`}
                            autoComplete="name"
                            isFocused={true}
                            onChange={(e) => setData('name', e.target.value)}
                            required
                        />
                        <InputError message={errors.name} className="mt-2" />
                    </div>

                    <div className="mt-6">
                        <InputLabel htmlFor="email" value="Email" className="text-black" />
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className={`mt-1 block w-full text-black dark:text-gray-300 ${borderColor} rounded-md p-2`}
                            autoComplete="username"
                            onChange={(e) => setData('email', e.target.value)}
                            required
                        />
                        <InputError message={errors.email} className="mt-2" />
                    </div>

                    <div className="mt-6">
                        <InputLabel htmlFor="password" value="Senha" className="text-black" />
                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            value={data.password}
                            className={`mt-1 block w-full text-black dark:text-gray-300 ${borderColor} rounded-md p-2`}
                            autoComplete="new-password"
                            onChange={(e) => setData('password', e.target.value)}
                            required
                        />
                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    <div className="mt-6">
                        <InputLabel htmlFor="password_confirmation" value="Confirme a Senha" className="text-black" />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            value={data.password_confirmation}
                            className={`mt-1 block w-full text-black dark:text-gray-300 ${borderColor} rounded-md p-2`}
                            autoComplete="new-password"
                            onChange={(e) => setData('password_confirmation', e.target.value)}
                            required
                        />
                        <InputError message={errors.password_confirmation} className="mt-2" />
                    </div>

                    <div className="mt-6 flex items-center justify-end">
                        <Link
                            href={route('login')}
                            className="rounded-md text-sm underline text-black hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-black dark:hover:text-gray-300"
                        >
                            Já tem uma conta?
                        </Link>

                        <PrimaryButton className="ms-4" disabled={processing}>
                            Registrar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </GuestLayout>
    );
}

import { Container, Row, Col } from 'react-bootstrap';
import { Head, Link } from '@inertiajs/react';
import 'bootstrap/dist/css/bootstrap.min.css';

export default function Welcome() {
    return (
        <>
            <Head title="Bem-vindo à Prosa" />
            
            <div className="min-vh-100 d-flex align-items-center bg-light">
                <Container>
                    <Row className="align-items-center g-5">
                        {/* Texto e Botões */}
                        <Col md={6} className="order-2 order-md-1">
                            <div className="text-center text-md-start pe-lg-5">
                                <h1 className="display-4 fw-bold text-dark mb-4">
                                    Bem-vindo à Prosa
                                </h1>
                                <p className="lead text-muted mb-5">
                                    Soluções inovadoras para gestão de relacionamentos 
                                    e desenvolvimento sustentável
                                </p>
                                <div className="d-flex flex-column flex-sm-row gap-2 justify-content-center justify-content-md-start">
                                    <Link 
                                        href={route('login')}
                                        className="btn btn-success btn-lg px-5 py-3 rounded-3 shadow-sm"
                                    >
                                        Acessar Plataforma
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="btn btn-outline-success btn-lg px-5 py-3 rounded-3 shadow-sm border-2"
                                    >
                                        Criar Nova Conta
                                    </Link>
                                </div>
                            </div>
                        </Col>

                        {/* Imagem */}
                        <Col md={6} className="order-1 order-md-2">
                            <div className="position-relative mx-auto" style={{ maxWidth: '500px' }}>
                                <div className="ratio ratio-1x1">
                                    <div className="rounded-circle overflow-hidden border-4 border-success shadow-lg hover-zoom">
                                        <img
                                            src="https://s3-sa-east-1.amazonaws.com/projetos-artes/fullsize%2f2017%2f08%2f17%2f20%2fLogo-e-Papelaria-219990_68710_201540113_1824854117.jpg"
                                            alt="Logo Prosa"
                                            className="object-fit-cover"
                                        />
                                    </div>
                                </div>
                            </div>
                        </Col>
                    </Row>
                </Container>
            </div>

            <style global jsx>{`
                .object-fit-cover {
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                }
                
                .btn-success {
                    transition: all 0.3s ease;
                    background-color: #198754;
                }
                
                .btn-success:hover {
                    background-color: #146c43 !important;
                    transform: translateY(-2px);
                }
                
                .btn-outline-success {
                    transition: all 0.3s ease;
                    color: #198754;
                    border-color: #198754;
                }
                
                .btn-outline-success:hover {
                    background-color: #f8f9fa !important;
                }

                .hover-zoom {
                    transition: transform 0.3s ease;
                }

                .hover-zoom:hover {
                    transform: scale(1.05);
                }

                @media (max-width: 768px) {
                    .display-4 {
                        font-size: 2.5rem;
                    }
                    .lead {
                        font-size: 1.1rem;
                    }
                }
            `}</style>
        </>
    );
}
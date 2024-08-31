import Container from "react-bootstrap/Container";
import Nav from "react-bootstrap/Nav";
import Navbar from "react-bootstrap/Navbar";
import { Link } from "react-router-dom";

function Header() {
    return (
        <Navbar bg="dark" data-bs-theme="dark">
            <Container>
                <Navbar.Brand href="#home">Navbar</Navbar.Brand>
                <Nav className="me-auto">
                    <Link to="/login">Login</Link>
                    <Link to="/register">Register</Link>
                </Nav>
            </Container>
        </Navbar>
    );
}

export default Header;

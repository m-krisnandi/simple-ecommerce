import Home from "./components/Home";
import Navbar from "./components/Navbar";
import Sidebar from "./components/Sidebar";

function App() {
    return (
        <div className="d-flex">
            <div className="w-auto">
                <Sidebar />
            </div>

            <div className="col">
                <Navbar />
                <Home />
            </div>
        </div>
    );
}

export default App;

import { useState } from "react";

const Sidebar = () => {
    const [active, setActive] = useState(1);
    return (
        <div className="sidebar d-flex justify-content-between flex-column bg-dark text-white py-3 ps-3 pe-5 vh-100">
            <div>
                <span className="p-3">
                    <i className="bi bi-code-slash fs-4 me-4"></i>
                    <span className="fs-3">E-commerce</span>
                </span>
                <hr className="text-white mt-2" />
                <ul className="nav nav-pills flex-column mt-3">
                    <li
                        className={
                            active === 1
                                ? "active nav-item p-2"
                                : "nav-item p-2"
                        }
                        onClick={(e) => setActive(1)}
                    >
                        <span className="p-1">
                            <i className="bi bi-speedometer2 me-3 fs-4"></i>
                            <span className="fs-4">Dashboard</span>
                        </span>
                    </li>
                    <li
                        className={
                            active === 2
                                ? "active nav-item p-2"
                                : "nav-item p-2"
                        }
                        onClick={(e) => setActive(2)}
                    >
                        <span className="p-1">
                            <i className="bi bi-box-seam me-3 fs-4"></i>
                            <span className="fs-4">Products</span>
                        </span>
                    </li>
                    <li
                        className={
                            active === 3
                                ? "active nav-item p-2"
                                : "nav-item p-2"
                        }
                        onClick={(e) => setActive(3)}
                    >
                        <span className="p-1">
                            <i className="bi bi-table me-3 fs-4"></i>
                            <span className="fs-4">Orders</span>
                        </span>
                    </li>
                    <li
                        className={
                            active === 4
                                ? "active nav-item p-2"
                                : "nav-item p-2"
                        }
                        onClick={(e) => setActive(4)}
                    >
                        <span className="p-1">
                            <i className="bi bi-people me-3 fs-4"></i>
                            <span className="fs-4">Users</span>
                        </span>
                    </li>
                </ul>
            </div>
            <div>
                <hr className="text-white" />
                <div className="nav-item p-2">
                    <span className="p-1">
                        <i className="bi bi-person-circle me-3 fs-4"></i>
                        <span className="fs-4">Admin</span>
                    </span>
                </div>
            </div>
        </div>
    );
};

export default Sidebar;

import React from "react";

function Home() {
    return (
        <div>
            <div className="container-fluid">
                <div className="row">
                    <div
                        className="d-flex justify-content-around align-items-center
                col-12 col-sm-6 col-md-4 col-lg-3 p-3 bg-white border border-secondary shadow-sm"
                    >
                        <i className="bi bi-box-seam fs-1"></i>
                        <div>
                            <span>Products</span>
                            <h2>321</h2>
                        </div>
                    </div>
                    <div
                        className="d-flex justify-content-around align-items-center
                col-12 col-sm-6 col-md-4 col-lg-3 p-3 bg-white border border-secondary shadow-sm"
                    >
                        <i className="bi bi-people fs-1"></i>
                        <div>
                            <span>Users</span>
                            <h2>23</h2>
                        </div>
                    </div>
                    <div
                        className="d-flex justify-content-around align-items-center
                col-12 col-sm-6 col-md-4 col-lg-3 p-3 bg-white border border-secondary shadow-sm"
                    >
                        <i className="bi bi-truck fs-1"></i>
                        <div>
                            <span>Order</span>
                            <h2>23</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Home;

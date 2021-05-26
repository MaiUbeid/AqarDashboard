import React, { useState } from 'react';
import { Card, Fade } from "react-bootstrap";

function EstateCard({ imageUrl }) {
    const [open, setOpen] = useState(false);

    return (
        <Card border="primary" className="bg-dark text-white text-center mb-4"
            onPointerOver={() => setOpen(!open)}
            onPointerOut={() => setOpen(false)}
            aria-controls="fade-div"
            aria-expanded={open}>
            <Card.Img variant="top" src={imageUrl} />
            <Fade in={open}>
                <Card.ImgOverlay>
                    <div id="fade-div" className="flex justify-content">
                        <button
                            type="button"
                            className="btn btn-success btn-md m-3"
                            onClick={() => undefined}
                        >
                            قبول
                        </button>
                        <button
                            type="button"
                            className="btn btn-danger btn-md m-3"
                            onClick={() => undefined}
                        >
                            رفض
                        </button>
                    </div>
                </Card.ImgOverlay>
            </Fade>
        </Card>
    )

}

export default EstateCard;
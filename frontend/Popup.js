import React, { useState, useEffect } from 'react';
import './popup.scss';

const Popup = () => {
    const [popups, setPopups] = useState([]);
    const [isVisible, setIsVisible] = useState(false);
    const [currentPopup, setCurrentPopup] = useState(null);
    
    useEffect(() => {
        fetchPopups();
    }, []);
    
    const fetchPopups = async () => {
        try {
            const response = await fetch('/wp-json/artistudio/v1/popup', {
                credentials: 'same-origin'
            });
            const data = await response.json();
            setPopups(data);
            
            // Check if any popup should be shown on current page
            const currentPath = window.location.pathname;
            const matchingPopup = data.find(popup => popup.page === currentPath);
            if (matchingPopup) {
                setCurrentPopup(matchingPopup);
                setIsVisible(true);
            }
        } catch (error) {
            console.error('Error fetching popups:', error);
        }
    };
    
    if (!isVisible || !currentPopup) return null;
    
    return (
        <div className="artistudio-popup-overlay">
            <div className="artistudio-popup-content">
                <button 
                    className="close-button"
                    onClick={() => setIsVisible(false)}
                >
                    ×
                </button>
                <h2>{currentPopup.title}</h2>
                <div dangerouslySetInnerHTML={{ __html: currentPopup.content }} />
            </div>
        </div>
    );
};

export default Popup;
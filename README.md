# 🎾 PadelUp! — Smart IoT Video Clipping System for Padel Courts

**PadelUp!** is an IoT-powered clipping system designed for padel courts.  
It records gameplay moments through smart sensors and cameras, and generates short video clips that can be viewed and downloaded via a connected web dashboard.  
The system bridges hardware and software — when the IoT button is pressed, it instantly saves the **last 30 seconds** of gameplay and uploads the clip to the web platform.

---

## 🚀 Features
- **Manual Trigger via Button** — The IoT device triggers the recording by saving the last 30 seconds of buffered video.  
- **Rolling Buffer Recording** — A continuous stream buffer ensures the previous 30 s of gameplay is always ready to clip.  
- **Web Dashboard** — A responsive dashboard where users can select their court, preview clips, and download videos.  
- **Real-Time Sync** — The trigger instantly notifies the backend to export and upload the clip.  
- **Simple Workflow** — *Press Button → System Saves Last 30 Seconds → View on Dashboard*.  
- **Designed for Players & Coaches** — Ideal for reviewing highlights and sharing best moments.

---

### How It Works
1. The camera continuously streams to a video buffer (60–90 s).  
2. When the IoT button is pressed, it sends a trigger signal to the backend.  
3. The backend instructs the video processor to export the **last 30 seconds** from the buffer.  
4. The clip is saved to storage and metadata recorded in the database.  
5. The web dashboard fetches the updated list of clips and displays them to the user.

---

## 📄 License
Copyright © 2025 **Future Developer**

This project — **PadelUp!** — is developed and maintained by **Future Developer**.  
All rights reserved. Redistribution, modification, and commercial use are permitted **with proper attribution** to Future Developer.

You are free to:
- Use this project for learning, research, and personal development.
- Modify the codebase for your own use.
- Reference or fork the repository for non-commercial or credited commercial projects.

Attribution Example:
> “Based on the PadelUp! IoT Clipping System by Future Developer (2025).”

Unauthorized reproduction without acknowledgment is prohibited.

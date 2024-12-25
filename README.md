# BeeHive-IoT

## Real-Time Monitoring and Control for Beekeeping

### Overview
BeeHive-IoT is an IoT-based system designed to help beekeepers monitor and control their hive environments effectively. By leveraging modern technologies like sensors, microcontrollers, fuzzy logic, and machine learning, this project ensures optimal conditions for honeybee colonies and enhances the sustainability of honey production.

---

![BeeHive Diagram](https://drive.google.com/uc?export=view&id=1e6zoVwYWVzxOJoda8LYEGewofkt2IMMV "BeeHive System Diagram") 



### Features
- **Real-Time Monitoring**  
  - Tracks key environmental parameters:
    - Temperature
    - Humidity
    - Weight
    - Sound
    - Light Intensity
- **Automated Control**  
  - Uses feedback-based logic to:
    - Activate fans for cooling
    - Trigger heaters for warmth
    - Adjust hive components via servo motors
- **Intelligent Decision-Making**  
  - Integrates **fuzzy logic** for dynamic control.
  - Employs **machine learning** for predictive analytics and adaptive optimization.
- **Web-Based Dashboard**  
  - Built with **PHP**, **JavaScript**, and **Bootstrap** for intuitive control and visualization.

---

### Tech Stack
| Technology       | Description                              |
|------------------|------------------------------------------|
| **C++**          | Firmware for microcontroller            |
| **PHP**          | Backend for data processing             |
| **JavaScript**   | Frontend logic for dashboard            |
| **Bootstrap**    | Responsive and modern UI design         |
| **Fuzzy Logic**  | Intelligent decision-making algorithm   |
| **Machine Learning** | Predictive and adaptive control models |

---

### How It Works
1. **Sensors**: Gather environmental data from the beehive.
2. **Microcontroller**: Processes sensor data using C++ firmware.
3. **Decision-Making**:  
   - Fuzzy logic adjusts actuators (e.g., fans, heaters, servo motors) based on real-time conditions.
   - Machine learning predicts trends and suggests optimizations.
4. **Web Dashboard**:  
   - Displays real-time data and historical trends.
   - Allows manual control of hive parameters.

---

### Getting Started
#### Prerequisites
- Microcontroller (e.g., Arduino, ESP32, etc.)
- Sensors for temperature, humidity, weight, sound, and light.
- Actuators such as fans, heaters, and servo motors.
- Web server with PHP support.
- Basic knowledge of Git and programming.

#### Wokwi Simulation
![Wokwi](https://drive.google.com/uc?export=view&id=1o5pxViUe0Xiy6vMVhP4PblMPO7kAhSTA "Wokwi Simulation")

We have created a comprehensive simulation for the BeeHive-IoT system using [Wokwi](https://wokwi.com), a powerful online microcontroller simulator. You can view and interact with the simulation via the link below:

👉 **[Click here to access the BeeHive-IoT simulation on Wokwi](https://wokwi.com/projects/418281998770483201)** 👈

### How to Use the Simulation??
1. Open the link above to access the Wokwi simulation.
2. Click the "Play" button to start the simulation.
3. Observe how the system processes real-time data from sensors and controls actuators.
4. You can modify parameters and observe the changes in real-time.
---

### Screenshots
<details>
<summary>📸 Click to view project images screenshot</summary>

### Gambar 1: Diagram Sistem
#### 1.1 Time Series
![Time Series](https://drive.google.com/uc?export=view&id=1JXIzI2ncv2yC1AUmxR7-DbqWJHvqFe6_ "Time Series Visualization")

#### 1.2 Predictive Analysis
![Predictive Analysis](https://drive.google.com/uc?export=view&id=1bAuw-t5H1YrMzvOfSu6XFKCArTNaLw0S "Predictive Analysis Dashboard")

#### 1.3 Pattern and Trends
![Pattern and Trends](https://drive.google.com/uc?export=view&id=1FdlHtIFiMSR0ETZyj6YKDrkbsUfDasFg "Pattern and Trends Visualization")

#### 1.4 Data Processing
![Data Processing](https://drive.google.com/uc?export=view&id=1bo020iDyc72Kt7DQ7adGODgIa5-idpDy "Data Processing Flow")

#### 1.5 Database
![Database](https://drive.google.com/uc?export=view&id=1rA9w03WqP7MsPtx0izTKoFlAp1VMUNHw "Database Structure")

</details>

---

### Future Improvements
- Add support for additional sensors.
- Integrate advanced machine learning models for better predictions.
- Develop a mobile application for monitoring and control.

---

### Acknowledgments
- Inspiration: The critical role of honeybees in ecosystems.
- Tools: Open-source software and hardware technologies.

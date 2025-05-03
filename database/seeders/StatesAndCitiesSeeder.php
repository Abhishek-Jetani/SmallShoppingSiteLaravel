<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\State;
use App\Models\City;



class StatesAndCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            'Andhra Pradesh' => ['Anantapur', 'Eluru', 'Guntur', 'Kakinada', 'Kurnool', 'Machilipatnam', 'Nandyal', 'Nellore', 'Ongole', 'Rajahmundry', 'Srikakulam', 'Tirupati', 'Vijayawada', 'Visakhapatnam', 'Vizianagaram'],
            'Arunachal Pradesh' => ['Itanagar', 'Naharlagun', 'Pasighat'],
            'Assam' => ['Barpeta', 'Bongaigaon', 'Dhubri', 'Dibrugarh', 'Goalpara', 'Guwahati', 'Hailakandi', 'Jorhat', 'Karimganj', 'Nagaon', 'Sibsagar', 'Silchar', 'Tezpur', 'Tinsukia'],
            'Bihar' => ['Arrah', 'Begusarai', 'Bettiah', 'Bhagalpur', 'Bihar Sharif', 'Chapra', 'Darbhanga', 'Dehri', 'Gaya', 'Hajipur', 'Katihar', 'Madhubani', 'Motihari', 'Munger', 'Muzaffarpur'],
            'Chhattisgarh' => ['Ambikapur', 'Bhilai', 'Bilaspur', 'Dhamtari', 'Durg', 'Jagdalpur', 'Korba', 'Mahasamund', 'Raigarh', 'Raipur', 'Rajnandgaon'],
            'Goa' => ['Mapusa', 'Margao', 'Panaji', 'Ponda', 'Vasco da Gama'],
            'Gujarat' => ['Ahmedabad', 'Amreli', 'Anand', 'Bharuch', 'Bhavnagar', 'Bhuj', 'Botad', 'Dahod', 'Gandhidham', 'Gandhinagar', 'Godhra', 'Jamnagar', 'Junagadh', 'Kadi', 'Kapadvanj'],
            'Haryana' => ['Ambala', 'Bahadurgarh', 'Bhiwani', 'Charkhi Dadri', 'Faridabad', 'Fatehabad', 'Gohana', 'Gurgaon', 'Hansi', 'Hisar', 'Jind', 'Kaithal', 'Karnal', 'Kurukshetra', 'Mahendragarh'],
            'Himachal Pradesh' => ['Baddi', 'Bilaspur', 'Chamba', 'Dalhousie', 'Dharamsala', 'Hamirpur', 'Kangra', 'Kullu', 'Mandi', 'Palampur', 'Shimla', 'Sirmaur', 'Solan', 'Una'],
            'Jammu and Kashmir' => ['Anantnag', 'Baramulla', 'Kathua', 'Leh', 'Punch', 'Rajauri', 'Sopore', 'Srinagar', 'Udhampur'],
            'Jharkhand' => ['Bokaro Steel City', 'Chaibasa', 'Chatra', 'Chirkunda', 'Medininagar (Daltonganj)', 'Deoghar', 'Dhanbad', 'Dumka', 'Giridih', 'Gumia', 'Hazaribag', 'Jamshedpur', 'Jhumri Tilaiya', 'Lohardaga', 'Madhupur'],
            'Karnataka' => ['Bagalkot', 'Bangalore', 'Belgaum', 'Bellary', 'Bidar', 'Bijapur', 'Chamrajnagar', 'Chikkamagaluru', 'Chitradurga', 'Davanagere', 'Dharwad', 'Gadag', 'Gangavathi', 'Gulbarga', 'Hassan'],
            'Kerala' => ['Alappuzha', 'Badagara', 'Idukki', 'Kannur', 'Kasaragod', 'Kochi', 'Kollam', 'Kottayam', 'Kozhikode', 'Malappuram', 'Palakkad', 'Ponnani', 'Thalassery', 'Thiruvananthapuram', 'Thrissur'],
            'Madhya Pradesh' => ['Balaghat', 'Barwani', 'Betul', 'Bhopal', 'Burhanpur', 'Chhatarpur', 'Chhindwara', 'Damoh', 'Datia', 'Dewas', 'Dhar', 'Guna', 'Gwalior', 'Harda', 'Hoshangabad'],
            'Maharashtra' => ['Ahmednagar', 'Akola', 'Amravati', 'Aurangabad', 'Beed', 'Bhandara', 'Buldhana', 'Chandrapur', 'Dhule', 'Gadchiroli', 'Gondiya', 'Hingoli', 'Jalgaon', 'Jalna', 'Kolhapur'],
            'Manipur' => ['Bishnupur', 'Churachandpur', 'Imphal', 'Kakching', 'Lilong', 'Mayang Imphal', 'Thoubal', 'Ukhrul'],
            'Meghalaya' => ['Bagaha', 'Begusarai', 'Bettiah', 'Bhabua', 'Bihar Sharif', 'Bodh Gaya', 'Buxar', 'Chapra', 'Darbhanga', 'Dehri', 'Gaya', 'Hajipur', 'Jamalpur', 'Jamui', 'Jehanabad'],
            'Mizoram' => ['Aizawl', 'Champhai', 'Kolasib', 'Lunglei', 'Mamit', 'Saiha', 'Serchhip'],
            'Nagaland' => ['Dimapur', 'Kohima', 'Mokokchung', 'Tuensang', 'Wokha', 'Zunheboto'],
            'Odisha' => ['Balangir', 'Baleshwar', 'Barbil', 'Bargarh', 'Bhadrak', 'Bhawanipatna', 'Bhubaneswar', 'Brahmapur', 'Byasanagar', 'Cuttack', 'Dhenkanal', 'Jatani', 'Jharsuguda', 'Kendrapara'],
            'Punjab' => ['Abohar', 'Amritsar', 'Barnala', 'Batala', 'Bathinda', 'Dhuri', 'Faridkot', 'Fazilka', 'Firozpur', 'Firozpur Cantt', 'Gobindgarh', 'Gurdaspur', 'Hoshiarpur', 'Jagraon'],
            'Rajasthan' => ['Abu Road', 'Ajmer', 'Alwar', 'Beawar', 'Bharatpur', 'Bhilwara', 'Bhiwadi', 'Bikaner', 'Bundi', 'Chittorgarh', 'Churu', 'Daosa', 'Dausa', 'Didwana'],
            'Sikkim' => ['Gangtok', 'Gezing', 'Jorethang', 'Mangan', 'Namchi', 'Nayabazar', 'Rangpo', 'Singtam'],
            'Tamil Nadu' => ['Arcot', 'Aruppukkottai', 'Avadi', 'Chengalpattu', 'Chennai', 'Chidambaram', 'Coimbatore', 'Erode', 'Kanchipuram', 'Kanyakumari', 'Karur', 'Kodaikanal', 'Kumbakonam', 'Madurai'],
            'Telangana' => ['Adilabad', 'Bellampalli', 'Bhadrachalam', 'Bhainsa', 'Bhongir', 'Bodhan', 'Farooqnagar', 'Gadwal', 'Hyderabad', 'Jagtial', 'Jangaon', 'Kagaznagar', 'Kamareddy', 'Karimnagar'],
            'Tripura' => ['Agartala', 'Belonia', 'Dharmanagar', 'Kailasahar', 'Khowai', 'Pratapgarh', 'Udaipur'],
            'Uttar Pradesh' => ['Agra', 'Aligarh', 'Allahabad', 'Amroha', 'Auraiya', 'Ayodhya', 'Azamgarh', 'Bahraich', 'Ballia', 'Banda', 'Barabanki', 'Bareilly', 'Basti', 'Bhadohi'],
            'Uttarakhand' => ['Almora', 'Bazpur', 'Chamba', 'Dehradun', 'Haldwani', 'Haridwar', 'Kashipur', 'Manglaur', 'Mussoorie', 'Nagla', 'Nainital', 'Pauri', 'Pithoragarh', 'Raiwala'],
            'West Bengal' => ['Alipurduar', 'Arambagh', 'Asansol', 'Baharampur', 'Balurghat', 'Bankura', 'Bardhaman', 'Birbhum', 'Bishnupur', 'Bolpur', 'Budge Budge', 'Chakdaha', 'Chinsurah', 'Contai']
        ];

        foreach ($states as $stateName => $cities) {
            $state = State::create(['name' => $stateName]);
            foreach ($cities as $cityName) {
                City::create(['name' => $cityName, 'state_id' => $state->id]);
            }
        }
    }
}

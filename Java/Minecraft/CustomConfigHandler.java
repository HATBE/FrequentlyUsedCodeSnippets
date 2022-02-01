import java.io.File;
import java.io.IOException;
import org.bukkit.configuration.file.YamlConfiguration;

public class CustomConfigHandler extends ConfigHandler {
	
	private File configFile;

	public CustomConfigHandler(Main main, String name) {
		super(main);
		
		configFile = new File(main.getDataFolder(), name);
		config = YamlConfiguration.loadConfiguration(configFile);
		
		save();
	}
	
	@Override
	public void save() {
		try {
			config.save(configFile);
		} catch (IOException e) {
			System.out.println("Failed to save Customconfig");
			e.printStackTrace();
		}
	}

}
